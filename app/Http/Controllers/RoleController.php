<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
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
        return view('roles.index', ['roles' => Role::paginate(2)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();
        $permissions = Permission::all();

        return view('roles.create', [
            'role' => $role,
            'permissions' => $permissions
        ]);
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
            'slug' => 'required',
            'permissions' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('roles.create');
        }

        $data = $request->permissions;

        $json_data = [];

        foreach ($data as $d) {
           $db_data = Permission::where('id', $d)->value('name');

           array_push($json_data, [$db_data => true]);
        }

        $dada = array_merge(...$json_data);
        
        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $dada
        ]);

        return redirect()->route('roles.index')->with('status', "$role->name Role was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $data = $request->permissions;

        $json_data = [];

        foreach ($data as $d) {
           $db_data = Permission::where('id', $d)->value('name');

           array_push($json_data, [$db_data => true]);
        }

        $dada = array_merge(...$json_data);

        $role->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $dada
        ]);


        return redirect()->route('roles.index')->with('status', "$role->name Role was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);

        return redirect()->route('roles.index')->with('status', "$role->name Role was deleted");;
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $show = $request->input('show');

        $roles = Role::take($show)
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('slug', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        // return view('search', compact('collection'));
        return view('roles.search', compact('roles'));
    }

    // Generate PDF
    public function createPDF() {
        // retreive all records from db
        $roles_pdf = Role::all();
    
        // share data to view
        view()->share('roles_pdf', $roles_pdf);
        $pdf = PDF::loadView('pdf_view_role', $roles_pdf);
    
        // download PDF file with download method
        return $pdf->download('roles.pdf');
        }
}
