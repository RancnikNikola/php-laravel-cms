@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }} User</h1>
    <p>Surname: {{ $user->surname }}</p>
    <p>Email: {{ $user->email}}</p>
</div>
@endsection
