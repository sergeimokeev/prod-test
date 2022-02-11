@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <h1>Список товаров со статусом available</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Артикул</td>
                        <td>Имя</td>
                        <td>Статус</td>
                        <td>Описание</td>
                        <td>Дата создания</td>
                        <td>Дата изменения</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->art }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->status }}</td>
                            <td>
                                <ul>
                                    @foreach($product->data as $key => $item)
                                        @if($item)
                                            <li>{{ $key . ' : ' . $item }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td><a class="btn btn-secondary"
                                   href="{{ route('edit.product', $product->id) }}">Изменить</a></td>
                            <td>
                                <form action="{{ route('delete.product', $product->id) }}" method="post">
                                    <input class="btn btn-dark" type="submit" value="Удалить"/>
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('create.product') }}">Добавить товар</a>
                <form class="mt-2" action="{{ route('export.product') }}" method="get">
                    @csrf
                    <button class="btn btn-primary" type="submit">Экспорт всех товаров</button>
                </form>
                @if (session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
