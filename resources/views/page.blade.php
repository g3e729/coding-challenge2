@extends('layouts.app')

@section('content')
<div class="container">
    <div id="global-danger-message" class="alert alert-danger d-none" role="alert"></div>
    <div id="global-success-message" class="alert alert-success d-none" role="alert"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('partials.register')

            @include('partials.login')

            @include('announcements.index')

            @include('announcements.show')

            @include('announcements.form')

        </div>
    </div>
</div>
@endsection
