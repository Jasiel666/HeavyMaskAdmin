@extends('layout.layout')

@section('title', 'Admin Edit')

@section('content')
<div class="AdminBody">
    <h1>Edit Admin</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Update Form -->
    <form action="{{ route('admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This ensures the form uses a PUT request for updating -->
        
        <!-- Name Field (Pre-filled with existing name) -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password (Leave empty if you don't want to change):</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- Main Admin Checkbox -->
        <div class="form-group">
            <label for="is_main_admin">Is Main Admin:</label>
            <select name="is_main_admin" id="is_main_admin" class="form-control" required>
                <option value="1" {{ old('is_main_admin', $admin->is_main_admin) == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_main_admin', $admin->is_main_admin) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary mt-3">Update Admin</button>
    </form>
</div>
@endsection
