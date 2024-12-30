@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>customer_name</th>
                <th>customer_email</th>
                <th>payment_method</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>${{ $order->payment_method }}</td>
                    <td>${{ $order->total }}</td>
                    <td>
                        <form action="{{ route('shop.delete_history', ['id' => $order->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-success delete-to-history-button">delete</button>
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
