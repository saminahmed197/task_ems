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
    <div class="text-center auth-title">{{ $pageTitle ?? 'Forget Password' }}</div>

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

    @if(Session::has('success'))
        <div class="alert alert-success p-2">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('forgetPassword') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-warning">Reset Password</button>
        </div>

        <div class="auth-links mt-3">
            <a href="{{ route('userLogin') }}">Back to Login</a>
        </div>
    </form>
</div>

@endsection
