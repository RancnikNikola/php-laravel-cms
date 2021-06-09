@extends('layouts.app')

@section('content')
<div class="container">
<h1>Create New Page</h1>
    <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
        @include('pages.partials.form')
    </form>
</div>
@endsection
