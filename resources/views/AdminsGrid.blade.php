@extends('layout.layout')

@section('title', 'Admins List')

@section('content')
<div class="AdminBody">
    <h1>Admins</h1>
    <table class="AdminsTable table table-striped table-dark table-bordered rounded-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Admin</th>
                <th>Permissions Type</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->is_main_admin ? 'Main admin' : 'Normal admin' }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td>{{ $admin->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

