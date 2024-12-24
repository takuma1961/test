@extends('layouts.app')

@section('content')
    <h1>Add New Product</h1>
    <form action="{{ route('shop.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <lavel for="name">Product Name</lavel>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <lavel for="description">Description</lavel>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <lavel for="price">Price</lavel>
            <input type="number" id="price" name="price" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
@endsection
