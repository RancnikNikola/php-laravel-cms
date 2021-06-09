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
            <span><h1>Roles<a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm ml-2">Create New</a></h1></span>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="bg-dark p-2 m-0 text-white">All Roles</p>
        </div>
    </div>
    <div class="container-fluid m-2">
        <form action="{{ route('search_roles') }}" method="GET" class="form-inline">
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
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Roles"/>                 
            <button type="submit" class="btn btn-outline-success my-2 my-sm-1">Search</button>
        </div>
        </form>
    </div>

    @if($roles)

    <table class="table table-striped bg-white">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($roles as $role)
            <tr>
                <td>
                    <a href="{{ route('roles.show', ['role' => $role->id ]) }}">{{ $role->name }}</a>
                </td>
                <td>{{ $role->slug }}</td>
                
                <td>
                    @foreach($role->permissions as $key => $value)
                    {{ $key }},
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('roles.edit', ['role' => $role->id ]) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault()
                    document.getElementById('delete-role-form-{{ $role->id }}').submit()">
                        Delete
                    </button>
                    <form id="delete-role-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                        @csrf

                        @method("DELETE")
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @else 
    <div>
        <h2>No roles found</h2>
    </div>
@endif

</div>
@endsection