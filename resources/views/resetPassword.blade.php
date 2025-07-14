@extends('layout/layout-common')

@section('space-work')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .auth-container {
        max-width: 420px;
        margin: 80px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }

    .ems-header {
        text-align: center;
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #0d6efd;
    }

    .auth-title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #212529;
    }

    .btn-yellow {
        background-color: #ffc107;
        color: #000;
        font-weight: 500;
    }

    .btn-yellow:hover {
        background-color: #e0a800;
        color: #fff;
    }

    .auth-links {
        text-align: center;
        margin-top: 15px;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
</style>

<div class="auth-container">
    <div class="ems-header">Equity Management System</div>
    <div class="auth-title">Reset Password</div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resetPassword') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $user[0]['id'] }}">

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-yellow">Reset Password</button>
        </div>
    </form>

    <div class="auth-links">
        <a href="{{ route('userLogin') }}">Back to Login</a>
    </div>
</div>
@endsection
