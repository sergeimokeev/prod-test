@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="py-1 d-flex justify-content-center">
                <a href="{{ route('products') }}" class="btn btn-primary" title="Перейти">Перейти к списку товаров</a>
            </div>
        </div>
    </div>
</div>
@endsection
