@extends('layouts.admin')

@section('title', 'Products | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/list-product.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper">
                <div>
                    <h1>Products</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('admin.dashboard') }}">Home</a></span>
                        <span><img src="/assets/svg/arrow-down.svg" style="transform: rotate(-90deg)"
                                alt="" /></span>Products
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        Add Product</a>
                </div>
            </div>
            <div class="row">
                <div class="card card-default">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="dataTables_wrapper">
                                <div class="top-information">
                                    <div class="dataTables_filter">
                                        <form action="{{ route('admin.products.index') }}" method="GET" id="search-form">
                                            <label>Search &nbsp;<input type="search" name="search" class="form-search"
                                                    placeholder="" value="{{ request()->query('search') }}" /></label>
                                        </form>
                                    </div>
                                </div>
                                <table class="table dataTable no-footer" style="width: 100%">
                                    <thead>

                                        <tr>
                                            <th style="width: 81.8px">Product</th>
                                            <th style="width: 81.8px">ID</th>
                                            <th style="width: 405.4875px">Name</th>
                                            <th style="width: 105.85px">Price</th>
                                            <th style="width: 105.925px">Stock</th>
                                            <th style="width: 205.9125px">Category</th>
                                            <th style="width: 205.5625px">Agency</th>
                                            <th style="width: 70px">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    @if (!empty($product->images))
                                                        <img class="thumbnail"
                                                            src="{{ asset('storage/' . $product->images[0]) }}" />
                                                    @else
                                                        <img class="thumbnail"
                                                            src="https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)" />
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $product->id }}
                                                </td>

                                                <td>
                                                    {{ $product->name }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($product->price, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    {{ $product->stock }}
                                                </td>
                                                <td>
                                                    {{ $product->category->name }}
                                                </td>
                                                <td>
                                                    {{ $product->agency->name }}
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.products.edit', $product->id) }}">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.833 17.5H17.4997" stroke="#9A9CAA"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M16.7209 6.16186L5.91639 17.0095C5.60365 17.3235 5.17872 17.5 4.73554 17.5H3.33652C2.87452 17.5 2.5 17.1222 2.5 16.6602V15.2489C2.5 14.808 2.67468 14.3851 2.98581 14.0727L13.7931 3.22234C16.3027 1.12267 18.8122 4.06218 16.7209 6.16186Z"
                                                                    stroke="#9A9CAA" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M12.7578 4.42578L15.6059 7.2739" stroke="#9A9CAA"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit">
                                                                <svg width="20" height="20" viewBox="0 0 20 20"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M3.33301 5.83398H16.6663" stroke="#FF8254"
                                                                        stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M5 8.33398L6.41784 16.1321C6.56193 16.9246 7.25215 17.5007 8.05763 17.5007H11.9423C12.7478 17.5007 13.4381 16.9246 13.5822 16.1321L15 8.33398"
                                                                        stroke="#FF8254" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path
                                                                        d="M7.5 4.16667C7.5 3.24619 8.24619 2.5 9.16667 2.5H10.8333C11.7538 2.5 12.5 3.24619 12.5 4.16667V5.83333H7.5V4.16667Z"
                                                                        stroke="#FF8254" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $products->links('vendor.pagination.admin') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('#search-form input[name="search"]').addEventListener('keypress', function(event) {

            if (event.key === 'Enter') {
                event.preventDefault();
                document.querySelector('#search-form').submit();
            }
        });
    </script>
@endsection
