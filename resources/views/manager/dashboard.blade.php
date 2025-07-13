@extends('layout/navbar-layout')

@section('space-work')
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
      <div class="text-center">
          <h2 class="mb-4" style="color: #2f89fc;">Welcome, <strong>{{ Auth::user()->name }}</h2>
      </div> 
    </div>
@endsection