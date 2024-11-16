@extends('layout.layout')

@section('title', 'Admin Create')

@section('content')
<div class="AdminBody">
    <h1 style="color: whitesmoke; font-weight: 700;">Create New Admin</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admins.store') }}" method="POST">
        @csrf 

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="is_main_admin">Is Main Admin:</label>
            <select name="is_main_admin" id="is_main_admin" class="form-control" required>
                <option value="1" {{ old('is_main_admin') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('is_main_admin') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Admin</button>
    </form>
</div>
@endsection
