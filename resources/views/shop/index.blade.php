@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('shop.create') }}" class="btn btn-primary">商品登録</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>name</th>
                <th>description</th>
                <th>price</th>
                <th>quantity</th>
                <th>Add to Cart</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>
                        <form action="{{ route('shop.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
