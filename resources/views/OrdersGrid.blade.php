@extends ('layout.layout')

@section('Orders', 'Orders table')

@section('content')
<div class="AdminBody">
<h1>Orders</h1>
<table class="AdminsTable  table table-striped table-dark table-bordered rounded-table">
        <thead>
            <tr>
                <th>Order N°</th>
                <th>User</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->total_price}}</td>
                    <td><div class="btn btn-primary">See details</div></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

