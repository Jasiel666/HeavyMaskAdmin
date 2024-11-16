@extends('layout.layout')

@section('title', 'Edit Shirt')

@section('content')
    <div class="container">
        <h1 style="color: whitesmoke; font-weight: 700;">Edit Shirt</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shirts.update', $shirt->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $shirt->name }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $shirt->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $shirt->price }}">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <input type="number" name="category_id" class="form-control" value="{{ $shirt->category_id }}">
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <input type="number" name="brand_id" class="form-control" value="{{ $shirt->brand_id }}">
            </div>
            <div class="form-group">
                <label for="ImageUrl">Image URL 1</label>
                <input type="url" name="ImageUrl" class="form-control" value="{{ $shirt->ImageUrl }}">
            </div>
            <div class="form-group">
                <label for="ImageUrl1">Image URL 2</label>
                <input type="url" name="ImageUrl1" class="form-control" value="{{ $shirt->ImageUrl1 }}">
            </div>
            <div class="form-group">
                <label for="ImageUrl2">Image URL 3</label>
                <input type="url" name="ImageUrl2" class="form-control" value="{{ $shirt->ImageUrl2 }}">
            </div>
            <button type="submit" class="btn btn-custom">Update</button>
        </form>
    </div>
@endsection
