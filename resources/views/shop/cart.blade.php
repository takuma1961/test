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
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty</p>
    @endif
    <a href="{{ route('shop.checkout') }}">Checkout</a>
@endsection
