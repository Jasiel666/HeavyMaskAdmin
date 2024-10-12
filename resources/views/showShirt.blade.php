@extends('layout.layout')

@section('title', 'Shirt Details')

@section('content')
    <div class="container ViewContainer">
        <h1>{{ $shirt->name }}</h1>
        <p>{{ $shirt->description }}</p>
        <p>Price: ${{ $shirt->price }}</p>
        <p>Category ID: {{ $shirt->category_id }}</p>
        <p>Brand ID: {{ $shirt->brand_id }}</p>
        <img src="{{ $shirt->ImageUrl }}" target="_blank"></img>
    </div>
@endsection
