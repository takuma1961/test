@extends('layouts.app')

@section('content')
    <h1>Cart</h1>
    @if (session('cart'))
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>${{ $details['price'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <input type="number" name="quantity" value="1" min="1"
                                    max="{{ $details['quantity'] }}" class="form-control"
                                    style="width: 70px; display: inline-block;">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty</p>
    @endif
    <a href="{{ route('shop.checkout') }}">Checkout</a>
@endsection
