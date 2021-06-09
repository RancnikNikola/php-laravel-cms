@extends('layouts.app')

@section('content')
<div class="container">
<h1>Edit {{ $page->title }} Page</h1>
    <form action="{{ route('pages.update', ['page' => $page->id ]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @include('pages.partials.form')
    </form>
</div>
@endsection
