@extends('layout.layout')

@section('title', 'Admin Create')

@section('content')
<div class="AdminBody">
    <h1>Create New Admin</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admins.update', $admin->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Add this for updating -->
    
    <div class="form-group">
        <label for="is_main_admin">Is Main Admin:</label>
        <select name="is_main_admin" id="is_main_admin" class="form-control" required>
            <option value="1" {{ $admin->is_main_admin == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $admin->is_main_admin == 0 ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update Admin Permissions</button>
</form>
</div>
@endsection
