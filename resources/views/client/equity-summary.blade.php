@extends('layout/navbar-layout')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('space-work')
<div class="container mt-4">
    <h3>Equity Summary Report</h3>

    <form method="GET" action="{{ route('reports.equity.summary') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <label>Client</label>
            <select name="client_id" class="form-control">
                <option value="all" {{ request('client_id') == "all" ? 'selected' : '' }}>All</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Sector</label>
                <select name="sector" id="sector" class="form-control">
                    <option value="all">-- ALL SECTORS --</option>
                    <option value="TECHNOLOGY" {{ request('sector') == "TECHNOLOGY" ? 'selected' : '' }}>Technology</option>
                    <option value="HEALTHCARE" {{ request('sector') == "HEALTHCARE" ? 'selected' : '' }}>Healthcare</option>
                    <option value="FINANCIALS" {{ request('sector') == "FINANCIALS" ? 'selected' : '' }}>Financials</option> 
                    <option value="ENERGY" {{ request('sector') == "ENERGY" ? 'selected' : '' }}>Energy</option>
                    <option value="CONSUMER DISCRETIONARY" {{ request('sector') == "CONSUMER DISCRETIONARY" ? 'selected' : '' }}>Consumer Discretionary</option>
                    <option value="CONSUMER STAPLES" {{ request('sector') == "CONSUMER STAPLES" ? 'selected' : '' }}>Consumer Staples</option>
                    <option value="INDUSTRIALS" {{ request('sector') == "INDUSTRIALS" ? 'selected' : '' }}>Industrials</option>
                    <option value="UTILITIES" {{ request('sector') == "UTILITIES" ? 'selected' : '' }}>Utilities</option>
                    <option value="REAL ESTATE" {{ request('sector') == "REAL ESTATE" ? 'selected' : '' }}>Real Estate</option>
                    <option value="COMMUNICATION" {{ request('sector') == "COMMUNICATION" ? 'selected' : '' }}>Communication</option>
                    <option value="MATERIALS" {{ request('sector') == "MATERIALS" ? 'selected' : '' }}>Materials</option>
                </select>
        </div>

        <div class="col-md-3">
            <label>From Date</label>
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>

        <div class="col-md-3">
            <label>To Date</label>
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>

        <div class="col-md-12 mt-2">
            <button class="btn btn-primary">Filter</button>
            <a href="{{ route('reports.equity.summary') }}" class="btn btn-secondary">Reset</a>

            @if($holdings->count() > 0)
                <a href="{{ route('reports.export.pdf', request()->query()) }}" class="btn btn-danger float-end ms-2">Export PDF</a>
                <a href="{{ route('reports.export.excel', request()->query()) }}" class="btn btn-success float-end">Export Excel</a>
            @endif
        </div>
    </form>

    @if($holdings->count() > 0)
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Stock</th>
                    <th>Sector</th>
                    <th>Quantity</th>
                    <th>Buy Price</th>
                    <th>Current Price</th>
                    <th>Total Value</th>
                    <th>Create Date</th>
                    <th>Last Price Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holdings as $holding)
                    <tr>
                        <td>{{ $holding->users->pluck('name')->join(', ') }}</td>
                        <td>{{ $holding->stock_symbol }}</td>
                        <td>{{ $holding->sector ?? '-' }}</td>
                        <td>{{ $holding->quantity }}</td>
                        <td>{{ $holding->buy_price }}</td>
                        <td>{{ $holding->current_price ?? '-' }}</td>
                        <td>{{ number_format( $holding->quantity * ($holding->current_price ?? 0), 2) }}</td>
                        <td>{{ $holding->created_at ?? '-' }}</td>
                        <td>{{ $holding->last_price_updated_at ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-4">No data found for selected filters.</div>
    @endif
</div>
@endsection
