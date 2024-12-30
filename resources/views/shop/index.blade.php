@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>name</th>
                <th>description</th>
                <th>price</th>
                <th>quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>
                    <form id="add-to-cart-form-{{ $product->id }}" action="{{ route('shop.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1">
                        <button type="submit" form="add-to-cart-form-{{ $product->id }}" class="btn btn-success add-to-cart-button">Add to Cart</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('scripts')
    <script src="{{ asset('js/confirmDeletion.js') }}"></script>
@endsection
