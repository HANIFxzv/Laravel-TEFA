@extends('layouts')

@section('content')
<h1>Register</h1>

<!-- Link to Login -->
<a href="{{ route('login') }}">Login</a>

<br><br>

<!-- Registration Form -->
<form action="{{ route('store') }}" method="POST">
    @csrf

    <!-- Name Input Field -->
    <label for="name">Nama Lengkap</label><br>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus><br>

    <!-- Display validation error for name -->
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <br><br>

    <!-- Email Input Field -->
    <label for="email">Email Address</label><br>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

    <!-- Display validation error for email -->
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <br><br>

    <!-- Password Input Field -->
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required><br>

    <!-- Display validation error for password -->
    @error('password')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <br><br>

    <!-- Confirm Password Input Field -->
    <label for="password_confirmation">Confirm Password</label><br>
    <input type="password" id="password_confirmation" name="password_confirmation" required><br>

    <!-- Display validation error for password confirmation -->
    @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    <br><br>

    <!-- Submit Button -->
    <button type="submit">Register</button>

</form>
@endsection
