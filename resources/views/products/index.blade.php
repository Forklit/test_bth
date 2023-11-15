@extends('layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <table class="table table-bordered text-sadness">
        <tr>
            <th>АРТИКУЛ</th>
            <th>НАЗВАНИЕ</th>
            <th>СТАТУС</th>
            <th>АТРИБУТЫ</th>
            <th><a class="btn btn-success bg-lucky px-4" href="{{ route('products.create') }}">Добавить</a></th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->article }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->status }}</td>
                <td>
                    @if(is_array($product->data['Color']))
                        Цвет: {{ implode(', ', $product->data['Color']) }}
                    @else
                        Цвет: {{ $product->data['Color'] }}
                    @endif
                    <br>
                    @if(is_array($product->data['Size']))
                        Размер: {{ implode(', ', $product->data['Size']) }}
                    @else
                        Размер: {{ $product->data['Size'] }}
                    @endif
                </td>
                
                <td>
                    <a class="btn btn-warning bg-lucky px-3" href="{{ route('products.show', $product->id) }}">
                        <i class="fas fa-eye"></i> View
                    </a>
                    <a class="btn btn-warning" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
