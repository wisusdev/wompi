@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
            @if(Session::has($key))
                <div class="alert alert-{{ $key }} alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">{{ Session::get($key) }}</p>
                </div>
            @endif
        @endforeach

        <form action="{{route('pay.wompi')}}" method="POST" id="paymentForm">
            @csrf
            <div class="card">
                <div class="card-header">
                    <img src="{{asset('images/logo.svg')}}" alt="logo">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <item-component></item-component>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group" id="toggler">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach ($data = ['card', 'bitcoin'] as $paymentPlatform)
                                        <label class="btn btn-outline-secondary rounded m-2 p-1" data-bs-target="#{{ $paymentPlatform }}Collapse" data-bs-toggle="collapse">
                                            <input type="radio" name="payment_platform" value="{{ $paymentPlatform }}" required>
                                            {{ $paymentPlatform }}
                                        </label>
                                    @endforeach
                                </div>
                                @foreach ($data = ['card', 'bitcoin'] as $paymentPlatform)
                                    <div id="{{ $paymentPlatform }}Collapse" class="collapse" data-bs-parent="#toggler">
                                        @includeIf('components.' . strtolower($paymentPlatform) . '-collapse')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <p class="m-0">Laravel v{{ Illuminate\Foundation\Application::VERSION }} <b>(PHP v{{ PHP_VERSION }})</b></p>
                    <div>
                        <button type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection