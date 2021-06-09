@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New User</h1>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @include('users.partials.form')
        </form>
</div>
@endsection
