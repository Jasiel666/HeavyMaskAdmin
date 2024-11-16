@extends('layout.layout')

@section('title', 'Order Details')

@section('content')
<div class="AdminBody">
    <h1>Order Details: Order #{{ $order->id }}</h1>
    <p><strong>User:</strong> {{ $order->user->name ?? 'Unknown User' }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Total Price:</strong> ${{ $order->total_price }}</p>

    <h2 style="color: whitesmoke; font-weight: 700;">Items in this Order</h2>
    <table class="AdminsTable table table-striped table-dark table-bordered rounded-table">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->size }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('OrderTable') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection
