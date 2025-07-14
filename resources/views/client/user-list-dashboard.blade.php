@extends('layout/navbar-layout')

@section('space-work')
<div class="container mt-5">
    <h2 class="mb-4">User List</h2>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" id="liveSearchInput" class="form-control live-search-input" placeholder="Search name, email, or phone...">
        </div>
    </div>
    <div id="userTable">
        @include('client.client-list-table', ['clients' => $clients])
    </div>

    
</div>

<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        const boxes = document.querySelectorAll('input[type=checkbox][name=\"client_ids[]\"]');
        boxes.forEach(box => box.checked = this.checked);
    });
    $('#liveSearchInput').on('keyup', function () {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('admin.clients.list') }}",
            type: "GET",
            data: { search: query },
            success: function (data) {
                $('#userTable').html(data);
            }
        });
    });
</script>
@endsection

