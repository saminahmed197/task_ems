{{-- stock-upload --}}

@extends('layout/navbar-layout')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('space-work')

<div class="container mt-5">
    <h2>Upload Stocks from Excel</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.uploadStocks') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Select Excel File</label>
            <input type="file" name="file" class="form-control" required accept=".xlsx,.xls">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
