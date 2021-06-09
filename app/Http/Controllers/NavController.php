<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Nav;
use App\Models\Page;
use Illuminate\Http\Request;

class NavController extends Controller
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
        $navs = Nav::all();

        return view('navs.index', [
            'navs' => $navs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('navs.create')->with([
            'nav' => new Nav(),
            'pages' => Page::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'page_id' => 'required'
        ]);

        $nav = Nav::create($data);
        $nav->save();

        return redirect()->route('navs.index')->with('status', "$nav->name Nav was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function show(Nav $nav)
    {
        return view('navs.show' , ['nav' => $nav]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function edit(Nav $nav)
    {
        return view('navs.edit', 
        ['nav' => $nav,
        'pages' => Page::all()
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nav $nav)
    {
        $nav->fill($request->only([
            'name', 'page_id'
        ]));

        $nav->save();

        return redirect()->route('navs.index')->with('status', "$nav->name Nav was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nav $nav)
    {
        Nav::destroy($nav->id);

        return redirect()->route('navs.index')->with('status', "$nav->name Nav was deleted");
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $show = $request->input('show');


        // DODAT VALIDACIJUUUUU ODE 


            $navs = Nav::take($show)
            ->where('name', 'LIKE', "%{$search}%")
            ->get();
        
        // Return the search view with the resluts compacted
        // return view('search', compact('collection'));
        return view('navs.search', compact('navs'));
    }

            // Generate PDF
            public function createPDF() {
                // retreive all records from db
                $navs_pdf = Nav::all();
          
                // share data to view
                view()->share('navs_pdf', $navs_pdf);
                $pdf = PDF::loadView('pdf_view_nav', $navs_pdf);
          
                // download PDF file with download method
                return $pdf->download('navs.pdf');
              }
}
