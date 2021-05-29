@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $role->name }} Role</h1>
    <p>Name: {{ $role->name }}</p>
    <p>Slug: {{ $role->slug}}</p>
    <p>Permissions: {{ $role->permissions}}</p>
</div>
@endsection
