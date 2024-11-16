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
                    @if($order->status == 'Pending')
                    <td style="background-color: #d1a200;">{{ $order->status }}</td>
                    @else
                    <td>{{ $order->status }}</td>
                    @endif
                    <td>{{ $order->total_price}}</td>
                    <td><a href="{{ route('OrderDetails.show', $order->id) }}" class="btn btn-primary">View details</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

