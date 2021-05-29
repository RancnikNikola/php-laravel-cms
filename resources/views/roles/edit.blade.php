@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit {{ $role->name }} Role</h1>
        <form action="{{ route('roles.update', [$role->id]) }}" method="POST">
            @method('PATCH')
            @include('roles.partials.form')
        </form>
</div>
@endsection
