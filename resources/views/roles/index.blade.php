@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New</a>
    <table class="table">
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
                <td>{{ $role->permissions }}</td>
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
</div>
@endsection
