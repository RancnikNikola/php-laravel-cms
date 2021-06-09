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
            <span><h1>Navs<a href="{{ route('navs.create') }}" class="btn btn-primary btn-sm ml-2">Create New</a></h1></span>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="bg-dark p-2 m-0 text-white">All Navs</p>
        </div>
    </div>
    <div class="container-fluid m-2">
        <form action="{{ route('search_navs') }}" method="GET" class="form-inline">
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
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Navs"/>                 
            <button type="submit" class="btn btn-outline-success my-2 my-sm-1">Search</button>
        </div>
        </form>
    </div>
 
    @if($navs)
    <table class="table table-striped bg-white">
        <thead>
            <tr>
                <th>Name</th>
                <th>Page ID</th>
                <th>Related Page</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($navs as $nav)
            <tr>
                <td>
                    <a href="{{ route('navs.show' , ['nav' => $nav->id ]) }}">{{ $nav->name }}</a>
                </td>
                <td>{{ $nav->page_id }}</td>
                <td>{{ $nav->page->title }}</td>
                <td>
                    <a href="{{ route('navs.edit', ['nav' => $nav->id ]) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault()
                    document.getElementById('delete-nav-form-{{ $nav->id }}').submit()">
                        Delete
                    </button>
                    <form id="delete-nav-form-{{ $nav->id }}" action="{{ route('navs.destroy', $nav->id) }}" method="POST">
                        @csrf

                        @method("DELETE")
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else 
    <div>
        <h2>No navs found</h2>
    </div>
@endif

</div>
@endsection

