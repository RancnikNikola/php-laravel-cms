@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }} User</h1>
    <p>Surname: {{ $user->surname }}</p>
    <p>Email: {{ $user->email}}</p>

    <div class="col-6">
        @if ($user->usrimg) 
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('storage/' . $user->usrimg) }}">
                </div>
            </div>
        @endif  
    </div>
</div>
@endsection
