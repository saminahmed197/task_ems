@extends('layout/layout-common')

@section('space-work')

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link href="{{ asset('css/toaster/toastr.css') }}" rel="stylesheet" />

<style>
    .auth-container {
        max-width: 450px;
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
</style>

<div class="auth-container">
    <div class="ems-header">Equity Management System</div>
    <div class="text-center auth-title">{{ $pageTitle ?? 'Register' }}</div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger p-2">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Success Message --}}
    @if(Session::has('success'))
        <div class="alert alert-success p-2">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('managerAnalystRegister') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter phone" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11" required>
            <div id="phoneError" class="text-danger mt-1"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="is_admin" class="form-select" required>
                <option value="" disabled selected>Select Role</option>
                <option value="3">Client</option>
                <option value="0">Manager</option>
                <option value="2">Analyst</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            <div id="passwordError" class="text-danger mt-1"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" placeholder="Confirm password" required>
            <div id="confirmPasswordError" class="text-danger mt-1"></div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Register</button>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirmPassword').value.trim();
        const errorDiv = document.getElementById('confirmPasswordError');

        errorDiv.innerText = '';

        if (password !== confirmPassword) {
            e.preventDefault(); 
            errorDiv.innerText = 'Passwords do not match.';
            toastr['error']('Passwords do not match. Please key in same password!', "error", {
                positionClass: 'toast-top-right',
                closeButton: !0,
                autohide: false
            });

            return false;
        }
    });
</script>

@endsection
