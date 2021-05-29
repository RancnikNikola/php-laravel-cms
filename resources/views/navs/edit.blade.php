@extends('layouts.app')

@section('content')
<div class="container">
<h1>Edit {{ $nav->name }} Nav</h1>
    <form action="{{ route('navs.update', ['nav' => $nav->id ]) }}" method="POST">
        @method('PATCH')
        @include('navs.partials.form')
    </form>
</div>
@endsection
