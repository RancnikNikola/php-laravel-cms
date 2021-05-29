@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('navs.create') }}" class="btn btn-primary">Create New</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Page ID</th>
                <th>Related Page</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($navs as $nav)
            <tr>
                <td>
                    <a href="{{ route('navs.show' , ['nav' => $nav->id ]) }}">{{ $nav->name }}</a>
                </td>
                <td>{{ $nav->page_id }}</td>
                <td>{{ $nav->page->title }}</td>
                <td>
                    <a href="{{ route('navs.edit', ['nav' => $nav->id ]) }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
