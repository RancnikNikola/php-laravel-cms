@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1>{{ $page->title }}</h1>
            <p>CONTENT: {{ $page->content}}</p>
            @can('update-page', $page)
            <form action="{{ route('pages.update', ['page' => $page->id ]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @include('pages.partials.formimg')
            </form>
            @endcan
        </div>
        <div class="col-6">
            @if ($page->image) 
                <div class="row">
                    <div class="col-6">
                        <img src="{{ asset('storage/' . $page->image) }}" class="img-thumbnail">
                    </div>
                </div>
            @endif  
        </div>
    </div>
</div>
@endsection
