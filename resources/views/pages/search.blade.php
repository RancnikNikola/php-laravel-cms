@extends('layouts.app')

@section('content')
<div class="p-2 m-2 jumbotron">
    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif


    <div class="row">
        <div class="col-6">
            @can('create-page')
            <span><h1>Pages<a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm ml-2">Create New</a></h1></span>
            @endcan 
            @cannot('create-page')
            <span><h1>Pages<a href="#" class="btn btn-primary btn-sm ml-2">Create New</a></h1></span>
            @endcannot
        </div>
    </div>


    <div class="row">
        <div class="col">
            <p class="bg-dark p-2 m-0 text-white">All Pages</p>
        </div>
    </div>
    <div class="container-fluid m-2">
        <form action="{{ route('search_pages') }}" method="GET" class="form-inline">
        <div class="form-group">
            <label for="show">Show</label>
            <select id="show" name="show" class="form-control ml-3">
                <option></option>
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
           <span class="ml-2">entries</span>
        </div>
        <div class="form-group col-sm-7">
            
        </div>
        <div class="form-group">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Pages"/>                 
            <button type="submit" class="btn btn-outline-success my-2 my-sm-1">Search</button>
        </div>
        </form>
    </div>

    @if($pages)

    <table class="table table-striped bg-white">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($pages as $page)
            <tr>
                <td>
                    @can('view-page')
                    <a href="{{ route('pages.show', ['page' => $page->id ]) }}">{{ $page->title }}</a>
                    @endcan
                    @cannot('view-page')
                    <p>{{ $page->title }}</p>
                    @endcannot
                </td>
                <td>
                    @can('update-page', $page)
                    <a href="{{ route('pages.edit', ['page' => $page->id ]) }}" class="btn btn-primary">Edit</a>
                    @endcan
                    @cannot('update-page', $page)
                    <a href="#" class="btn btn-primary">Edit</a>
                    @endcannot
                    @can('delete-page')
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault()
                    document.getElementById('delete-page-form-{{ $page->id }}').submit()">
                        Delete
                    </button>
                    @endcan
                    @cannot('delete-page')
                    <button type="button" class="btn btn-danger">
                        Delete
                    </button>
                    @endcannot
                    <form id="delete-page-form-{{ $page->id }}" action="{{ route('pages.destroy', $page->id) }}" method="POST">
                        @csrf

                        @method("DELETE")
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else 
    <div>
        <h2>No pages found</h2>
    </div>
@endif

</div>
@endsection
