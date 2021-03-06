@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Edit {{ $user->name }} User</h1>

        <form action="{{ route('users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @method("PATCH")
            @include('users.partials.form')
        </form>
    
</div>
@endsection
