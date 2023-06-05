@extends('layouts.admin')

@section('title', 'Edit Product | ' . config('app.name'))

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/add-product.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper">
                <div>
                    <h1>Edit Product</h1>
                    <p class="breadcrumbs">
                        <span><a href="{{ route('admin.products.index') }}">Products</a></span>
                        <span><img src="/assets/svg/arrow-down.svg" style="transform: rotate(-90deg)"
                                alt="" /></span>Edit Product
                    </p>
                </div>
            </div>
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="add-prod-col">
                        <div class="card card-default">
                            <div class="card-header card-header-border-bottom">
                                <h2>Edit Product</h2>
                            </div>

                            <div class="card-body">
                                <div class="row thumbnailvendor-uploads">
                                    <div class="add-prod-col-left">
                                        <div class="thumbnailvendor-img-upload">
                                            <div class="thumbnailvendor-main-img">
                                                <div class="form-group">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type="file" id="imageUpload" name="images[]"
                                                                class=" thumbnailimage-upload form-control mt-2"
                                                                onchange="previewImage(event, {{ 0 }})"
                                                                required>
                                                            <label for="imageUpload"><img src="/assets/svg/edit.svg"
                                                                    class="svg_img header_svg" alt="edit" /></label>
                                                        </div>
                                                        <div class="avatar-delete">
                                                            @if (isset($product->images[0]))
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="remove_images[]"
                                                                        value="{{ $product->images[0] }}">
                                                                </div>
                                                            @endif


                                                        </div>
                                                        <div class="avatar-preview thumbnailpreview">
                                                            <div class="imagePreview thumbnaildiv-preview">
                                                                <img src="{{ isset($product->images[0]) ? asset('storage/' . $product->images[0]) : 'https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)' }}"
                                                                    class="card-img-top existing-image-{{ 0 }}"
                                                                    alt="Product Image">
                                                            </div>
                                                        </div>
                                                        @error('images')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        @error('images.*')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="thumb-upload-set">
                                                        @for ($i = 1; $i < 7; $i++)
                                                            <div class="thumb-upload">
                                                                <div class="thumb-edit">
                                                                    <input type="file" name="images[]"
                                                                        class="form-control mt-2 thumbnailimage-upload"
                                                                        onchange="previewImage(event, {{ $i }})"
                                                                        {{ $i <= 4 ? 'required' : '' }}>
                                                                    <label for="imageUpload"><img src="/assets/svg/edit.svg"
                                                                            class="svg_img header_svg"
                                                                            alt="edit" /></label>
                                                                </div>
                                                                <div class="thumb-delete">
                                                                    @if (isset($product->images[$i]))
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input"
                                                                                name="remove_images[]"
                                                                                value="{{ $product->images[$i] }}">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="thumb-preview thumbnailpreview">
                                                                    <div class="image-thumb-preview">
                                                                        <img src="{{ isset($product->images[$i]) ? asset('storage/' . $product->images[$i]) : 'https://dummyimage.com/765x765/eab8c1/ffffff.jpg&text=Insert+Image+Here+(1:1+Ratio)' }}"
                                                                            class="image-thumb-preview thumbnailimage-preview existing-image-{{ $i }}"
                                                                            alt="Product Image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-prod-col-right">
                                        <div class="thumbnailvendor-upload-detail">
                                            <div class="textform">
                                                <div class="addprod-title-col-long">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control slug-title"
                                                        id="name" value="{{ $product->name }}" />
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col-long">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" id="description" class="form-control" rows="2">{{ $product->description }}</textarea>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col">
                                                    <label for="price" class="form-label">Price</label>
                                                    <input type="number" name="price" id="price" class="form-control"
                                                        value="{{ $product->price }}" />
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col">
                                                    <label for="discounted_price" class="form-label">Discounted
                                                        Price</label>
                                                    <input type="number" name="discounted_price" id="discounted_price"
                                                        class="form-control" value="{{ $product->discounted_price }}" />
                                                    @error('discounted_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col">
                                                    <label for="stock" class="form-label">Stock</label>
                                                    <input type="number" name="stock" id="stock"
                                                        class="form-control" value="{{ $product->stock }}" />
                                                    @error('stock')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col">
                                                    <label for="category_id" class="form-label">Category</label>
                                                    <select name="category_id" id="category_id" class="form-select">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col">
                                                    <label for="agency_id" class="form-label">Agency</label>
                                                    <select name="agency_id" id="agency" class="form-select">
                                                        @foreach ($agencies as $agency)
                                                            <option value="{{ $agency->id }}"
                                                                {{ $product->agency_id == $agency->id ? 'selected' : '' }}>
                                                                {{ $agency->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('agency_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="addprod-title-col-long">
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(event, index) {
            const input = event.target;
            const reader = new FileReader();
            const previewImage = document.querySelector('.existing-image-' + index);

            reader.onload = function() {
                previewImage.src = reader.result;
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
