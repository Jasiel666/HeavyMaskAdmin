@extends('layout.layout')

@section('title', 'productsInsert')

@section('content')
<div class="InsertBody"> 
    <h1>Insert Products</h1>
    <div class="container" id="InsertContainer">

        <form id="productForm" method="post" enctype="multipart/form-data"  action="{{ route('Shirt.store') }}"> <!-- Added enctype here -->
            {{csrf_field()}}

            <label for="name">Name</label>   
            <input id="name" name="name" class="form-control mb-2" type="text" placeholder="Name" required>

            <label for="description">Description</label>   
            <input id="description" name="description" class="form-control mb-2" type="text" placeholder="Description">

            <label for="price">Price</label>   
            <input id="price" name="price" class="form-control mb-2" type="text" placeholder="Price" required>

            <label for="category_id">Select Shirt Category:</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="1">1 - Casual Shirts</option>
                <option value="2">2 - Formal Shirts</option>
                <option value="3">3 - Activewear Shirts</option>
                <option value="4">4 - Seasonal Shirts</option>
                <option value="5">5 - Graphic Shirts</option>
                <option value="6">6 - Specialty Shirts</option>
            </select>

            <label for="brand_id">Select Shirt Brand:</label>
            <select id="brand_id" name="brand_id" class="form-control">
                <option value="1">1 - HeavyMask Modern design made with sublimation and Screen Printing</option>
                <option value="2">2 - MamaSoyArtista Handcrafted shirts</option>
            </select>

            <label for="ImageUrl">Image 1</label>   
            <input id="ImageUrl" name="ImageUrl" class="form-control mb-2" type="file" required>

            <label for="ImageUrl1">Image 2</label>   
            <input id="ImageUrl1" name="ImageUrl1" class="form-control mb-2" type="file">

            <label for="ImageUrl2">Image 3</label>   
            <input id="ImageUrl2" name="ImageUrl2" class="form-control mb-2" type="file">

            <button type="submit" class="btnInsertShirt btn btn-primary mb-3">Insert Shirt</button>

        </form>
        <a class="btnSeeShirts btn-secondary" href="/shirts/list">See Shirts</a>
    </div>
</div>

@endsection
