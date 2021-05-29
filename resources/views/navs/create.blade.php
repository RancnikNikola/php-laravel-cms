@extends('layouts.app')

@section('content')
<div class="container">
<h1>Create New Nav</h1>
    <form action="{{ route('navs.store') }}" method="POST">
        @include('navs.partials.form')
    </form>
</div>
@endsection
