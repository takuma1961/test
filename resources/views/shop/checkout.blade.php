@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>
    <form action="{{ route('shop.placeOrder') }}" method="POST">
        @csrf
        <label for="customer_name">Name</label>
        <input type="text" id="customer_name" name="customer_name" required>

        <label for="customer_email">Email</label>
        <input type="email" id="customer_email" name="customer_email" required>

        <label for="payment_method">Payment Method</label>
        <select id="payment_method" name="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
        </select>

        <button type="submit">Place Order</button>
    </form>
@endsection
