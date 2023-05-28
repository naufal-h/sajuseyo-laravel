@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/list-product.css') }}">
@endsection

@section('content')
    <h1>Product List</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Agency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>

                        @if (!empty($product->images))
                            <img src="{{ asset('storage/' . $product->images[0]) }}" alt="Product Image" class="product-image"
                                width="100">
                        @else
                            No Image Available
                        @endif


                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->agency->name }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
