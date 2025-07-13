@extends('layout/layout-common')

@section('space-work')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .auth-container {
        max-width: 420px;
        margin: 80px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .auth-title {
        font-weight: bold;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .ems-header {
        text-align: center;
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #0d6efd;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }

    .auth-links {
        text-align: center;
        margin-top: 15px;
    }
</style>

<div class="auth-container">
    <div class="ems-header">Equity Management System</div>
    <div class="text-center auth-title">{{ $pageTitle ?? 'Log in' }}</div>

    @if($errors->any())
        <div class="alert alert-danger p-2">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger p-2">
            {{ Session::get('error') }}
        </div>
    @endif

    <form action="{{ route('userLogin') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="d-grid mb-2">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

        <div class="auth-links">
            <a href="/forget-password">Forgot Password?</a>
            <br>
            <a href="{{ route('register') }}">Don't have an account? Register</a>
        </div>
    </form>
</div>

@endsection

