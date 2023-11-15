@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-9 px-4 mt-3">
            <div class="pull-left">
                <h5>{{ $product->name }}</h5>
            </div>
        </div>
    </div>

    <div class="col-9 px-4 mt-2">
        <div class="form-group">
            <table class="border-0" style="border-collapse:separate; border-spacing: 10px;">
                <tr>
                    <td class="pe-3">Артикул</td>
                    <td>{{ $product->article }}</td>
                </tr>
                <tr>
                    <td class="pe-3">Название</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td class="pe-3">Статус</td>
                    <td>{{ $product->status }}</td>
                </tr>
                <tr>
                    <td class="pe-3">Аттрибуты</td>
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
                </tr>
            </table>
        </div>
    </div>
@endsection
