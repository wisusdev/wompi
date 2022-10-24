@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
            @if(Session::has($key))
                <div class="alert alert-{{ $key }} alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">{{ Session::get($key) }}</p>
                </div>
            @endif
        @endforeach

        <form-component></form-component>
        <div class="border p-3 rounded mb-3">
            <div class="d-flex align-items-center">
                <p class="m-0">Laravel v{{ Illuminate\Foundation\Application::VERSION }} <b>(PHP v{{ PHP_VERSION }})</b></p>
            </div>
        </div>
    </div>
</div>
@endsection