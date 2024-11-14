@extends('layout.layout')

@section('title', 'Admins List')

@section('content')
<div class="AdminBody">
    <!-- Debug information -->
    @if(Auth::guard('admin')->check())
        <div class="alert alert-info">
            Logged in as: {{ Auth::guard('admin')->user()->name }}<br>
            Is Main Admin: {{ Auth::guard('admin')->user()->is_main_admin ? 'Yes' : 'No' }}
        </div>
    @else
        <div class="alert alert-warning">
            Not logged in as admin
        </div>
    @endif

    <h1>Admins</h1>

    <div class="mb-3">
        <a href="{{ route('admins.create') }}" class="btn btn-success">Create New Admin</a>
    </div>

    <table class="AdminsTable table table-striped table-dark table-bordered rounded-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Admin</th>
                <th>Permissions Type</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin['id'] }}</td>
                    <td>{{ $admin['name'] }}</td>
                    <td>{{ $admin['is_main_admin'] ? 'Main admin' : 'Normal admin' }}</td>
                    <td>{{ $admin['created_at'] }}</td>
                    <td>{{ $admin['updated_at'] }}</td>
                    <td>
                        @if ($isMainAdmin)
                            <a href="{{ route('admins.edit', $admin['id']) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('admins.destroy', $admin['id']) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection