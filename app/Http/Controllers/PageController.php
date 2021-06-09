<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Models\Page;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PageController extends Controller
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
        $pages = Page::paginate(3);
     

        return view('pages.index', [
            'pages' => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create')->with(['page' => new Page()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = Auth::user()->pages()->save(new Page($this->validateRequest()));

        $this->storeImage($page);

        return redirect()->route('pages.index')->with('status', "$page->title Page was created");

    }

    private function validateRequest() {

        return tap(request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]), function () {

            if (request()->hasFile('image')) {
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });
        
    }

    private function validateUpdateRequest() {

        return tap(request()->validate([
            'title' => 'string',
            'content' => 'string',
        ]), function () {

            if (request()->hasFile('image')) {
                request()->validate([
                    'image' => 'file|image|max:5000',
                ]);
            }
        });
        
    }

    private function storeImage($page) {

        if (request()->has('image')) {
            $page->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
            $image = Image::make(public_path('storage/' . $page->image))->fit(400, 400);
            $image->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        
        $page->update($this->validateUpdateRequest());

        $this->storeImage($page);

        return redirect()->route('pages.index')->with('status', "$page->title Page was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Page::destroy($page->id);

        return redirect()->route('pages.index')->with('status', "$page->title Page was deleted");
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $show = $request->input('show');

        $pages = Page::take($show)
            ->where('title', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        // return view('search', compact('collection'));
        return view('pages.search', compact('pages'));
    }

        // Generate PDF
        public function createPDF() {
            // retreive all records from db
            $pages_pdf = Page::all();
      
            // share data to view
            view()->share('pages_pdf', $pages_pdf);
            $pdf = PDF::loadView('pdf_view_page', $pages_pdf);
      
            // download PDF file with download method
            return $pdf->download('pages.pdf');
          }
}
