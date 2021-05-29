@extends('layouts.app')

@section('content')
<div class="container">

    @can('create-page')
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Create New</a>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>

        @foreach ($pages as $page)
            <tr>
                <td>
                    @can('view-page')
                    <a href="{{ route('pages.show', ['page' => $page->id ]) }}">{{ $page->title }}</a>
                    @endcan
                </td>
                <td>{{ $page->url }}</td>
                <td>
                    @can('update-page', $page)
                    <a href="{{ route('pages.edit', ['page' => $page->id ]) }}" class="btn btn-primary">Edit</a>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
