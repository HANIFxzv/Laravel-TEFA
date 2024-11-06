@extends('layouts')

@section('content')

<h1>Login</h1>

<!-- Link to Registration -->
<a href="{{ route('register') }}">Daftar</a>

<br><br>

<!-- Login Form -->
<form action="{{ route('authenticate') }}" method="post">
    @csrf

    <!-- Email Input Field -->
    <label for="email">Email Address</label><br>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
    <!-- Display validation error for email -->
    @error('email')
        <div style="color: red;">{{ $message }}</div>
    @enderror
    <br><br>

    <!-- Password Input Field -->
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required>
    <!-- Display validation error for password -->
    @error('password')
        <div style="color: red;">{{ $message }}</div>
    @enderror
    <br><br>

    <!-- Submit Button -->
    <input type="submit" value="Login">

    <!-- Additional spacing -->
    <br><br>
</form>

@endsection
