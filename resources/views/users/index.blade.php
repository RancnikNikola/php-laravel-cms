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
            <span><h1>Users<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm ml-2">Create New</a></h1></span>
        </div>
        <div class="col-6">
            {{-- <form action="{{ route('search_users') }}" method="GET" class="form-inline my-2 my-lg-0 float-right">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search Users" required />
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
              </form> --}}
        </div>
    </div>
    
        
    <div class="row">
        <div class="col">
            <p class="bg-dark p-2 m-0 text-white">All Users</p>
        </div>
    </div>
    <div class="container-fluid m-2">
        <form action="{{ route('search_users') }}" method="GET" class="form-inline">
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
      
            <div class="btn-group col-md-6" role="group">
                <a class="btn btn-default" href="#">Copy</a>   
                <a class="btn btn-default" href="{{ route('users_to_csv') }}">CSV</a>
                <a class="btn btn-default" href="{{ route('users_to_excel') }}">Excel</a>      
                <a class="btn btn-default" href="{{ route('users_to_pdf') }}">PDF</a>      
                <input type="button" class="btn btn-default" value="Print" name="print" id="print">
            </div>
        <div class="form-group">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search Users"/>                 
            <button type="submit" class="btn btn-outline-success my-2 my-sm-1">Search</button>
        </div>
        </form>
    </div>
                
           
            <table class="table table-striped bg-white">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
        @foreach ($users as $user)
            <tr>
                <td>
                    @if ($user->usrimg)
                        <img src="{{ asset('storage/' . $user->usrimg) }}" class="rounded-circle">
                    @endif  
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>{{ $user->surname }}</td>
                <td><a href="{{ route('users.show', ['user' => $user->id ]) }}">{{ $user->email }}</a></td>
                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                <td>{{ ($user->updated_at->diffForHumans()) }}</td>
                <td>
                    <a href="{{ route('users.edit', ['user' => $user->id ]) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault()
                    document.getElementById('delete-user-form-{{ $user->id }}').submit()">
                        Delete
                    </button>
                    <form id="delete-user-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf

                        @method("DELETE")
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

<div class="row">
    <div class="col-6">
        {{ $users->firstItem() }} to {{ $users->lastItem() }} of total {{$users->total()}} entries
    </div>
    <div class="col-6">
        {{ $users->links() }}
    </div>
</div>
</div>
@endsection
