@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('create.product') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h1>Форма добавления товара</h1>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Название товара</label>
                                <div class="col-md-6">
                                    <input id="name" class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           type="text" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="art" class="col-md-4 col-form-label text-md-end">Артикул товара</label>
                                <div class="col-md-6">
                                    <input id="art" class="form-control @error('art') is-invalid @enderror" name="art"
                                           type="text" value="{{ old('art') }}">
                                    @error('art')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Статус</label>
                                <div class="col-md-6">
                                    <input id="status" class="form-control @error('status') is-invalid @enderror"
                                           name="status"
                                           type="text"
                                           value="{{ old('status') }}">
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="color" class="col-md-4 col-form-label text-md-end">Цвет</label>
                                <div class="col-md-6">
                                    <input id="color" class="form-control" name="color"
                                           type="text" value="{{ old('color') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="size" class="col-md-4 col-form-label text-md-end">Размер</label>
                                <div class="col-md-6">
                                    <input id="size" class="form-control" name="size"
                                           type="text" value="{{ old('size') }}">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary w-50">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger  mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
