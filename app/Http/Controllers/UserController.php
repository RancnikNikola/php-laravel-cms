<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Page;
use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use PDF;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $users = User::paginate(3);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create')->with([
            'user' => new User(),
            'roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'usrimg' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create');
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usrimg' => $request->usrimg
       ]);

       $this->storeImage($user);

       $user->roles()->attach($request->role);

       return redirect()->route('users.index')->with('status', "$user->name User was created");
    }


    private function storeImage($user) {

        if (request()->has('usrimg')) {
            $user->update([
                'usrimg' => request()->usrimg->store('uploads', 'public'),
            ]);
            $image = Image::make(public_path('storage/' . $user->usrimg))->fit(45, 45);
            $image->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if (Auth::user()->id == $user->id) {
            return redirect()->route('users.index')->with('status', 'You cannot edit yourself.');
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('users.index')->with('status', 'You cannot edit yourself.');
        }

        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usrimg' => $request->usrimg
        ]);

        $this->storeImage($user);

        $user->roles()->sync($request->role);

        return redirect()->route('users.index')->with('status', "$user->name was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect()->route('users.index')->with('status', "$user->name User was deleted");
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $show = $request->input('show');

        
    
        // Search in the name and emaik columns from the users table
        $users = User::take($show)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->get();

       
    
        // Return the search view with the resluts compacted
        // return view('search', compact('collection'));
        return view('users.search', compact('users'));
    }

    // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $users_pdf = User::all();
  
        // share data to view
        view()->share('users_pdf', $users_pdf);
        $pdf = PDF::loadView('pdf_view', $users_pdf);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }
}
