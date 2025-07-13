<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Equity Management System</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('css/toaster/toastr.js') }}"></script>
        <link href="{{ asset('css/toaster/toastr.css') }}" rel="stylesheet" />
    </head>
    <body>
        @yield('space-work')
        
        {{-- Global Scripts --}}
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
        <!-- <script src="" async defer></script> -->
        {{-- Page-specific Scripts --}}
        @yield('scripts')
    </body>
</html>