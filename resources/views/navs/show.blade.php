@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $nav->name }}</h1>
    <p>Page ID: {{ $nav->page_id }}</p>
    <p>Related Page: {{ $nav->page->title }}</p>
</div>
@endsection
