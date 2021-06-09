@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-3">
                <a href="/users">Users <i class="bi bi-people"></i></a>
            </div>
            <div class="col-3">
                <a href="/pages">Pages <i class="bi bi-files"></i></a>
            </div>
            <div class="col-3">
                <a href="/navs">Navs <i class="bi bi-list-nested"></i></a>
            </div>
            <div class="col-3">
                <a href="/roles">Roles <i class="bi bi-person-lines-fill"></i></a>
            </div>
        </div>
</div>
@endsection
