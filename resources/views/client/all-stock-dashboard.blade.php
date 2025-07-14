@extends('layout/navbar-layout')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('space-work')

<div class="container mt-5">
    <h2 class="mb-4">Stock List</h2>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" id="liveSearchInput" class="form-control live-search-input"  placeholder="Search name, email, phone...">
        </div>
    </div>
    <div id="userTable">
        @include('client.stocks-list-table', ['holdings' => $holdings, 'all_clients' => $all_clients])
    </div>

    
</div>

<script>
    $('#liveSearchInput').on('keyup', function () {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('stock.allStoredStocks') }}",
            type: "GET",
            data: { search: query },
            success: function (data) {
                $('#userTable').html(data);
            }
        });
    });
</script>
@endsection