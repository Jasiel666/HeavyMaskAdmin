@extends('layout.layout')

@section('title', 'Shirts List')

@section('content')
<div class="shirtsContainer">

    <h1>Shirts List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-dark table-bordered rounded-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Image URLs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shirts as $shirt)
                <tr>
                    <td>{{ $shirt->name }}</td>
                    <td>{{ $shirt->description }}</td>
                    <td>{{ $shirt->price }}</td>
                    <td>{{ $shirt->category_id }}</td>
                    <td>{{ $shirt->brand_id }}</td>
                    <td>
                        <a href="{{ $shirt->ImageUrl }}" target="_blank">Image 1</a><br>
                        <a href="{{ $shirt->ImageUrl1 }}" target="_blank">Image 2</a><br>
                        <a href="{{ $shirt->ImageUrl2 }}" target="_blank">Image 3</a>
                    </td>
                    <td>
                        <a href="{{ route('shirts.show', $shirt->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('shirts.edit', $shirt->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('shirts.destroy', $shirt->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this shirt?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
