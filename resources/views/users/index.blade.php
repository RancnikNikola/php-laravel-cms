@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('users.create') }}" class="btn btn-primary">Create New</a>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($users as $user)
            <tr>
                <td>
                    <img class="img-rounded" src="{{ asset('public/images/blank-profile-picture-973460_640.png') }}" />
                </td>
                <td>
                    <a href="{{ route('users.show', ['user' => $user->id ]) }}">{{ $user->name }}</a>
                </td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                <td>
                    <a href="{{ route('users.edit', ['user' => $user->id ]) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
