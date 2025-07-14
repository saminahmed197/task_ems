@foreach($holdings as $holding)
    <div class="card mb-3">
        <div class="card-header custom-header d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $holding->company_name }} ({{ $holding->stock_symbol }})</strong><br>
                Quantity: {{ $holding->quantity }} | Buy Price: {{ $holding->buy_price }} | Purchased: {{ $holding->purchase_date }}
                | Current Price: {{ $holding->current_price }}
            </div>
        </div>
        <div class="card-body">
            <h6>Associated Clients:</h6>
            <ul>
                @foreach($holding->users as $user)
                    <li>{{ $user->name }} ({{ $user->email }})</li>
                @endforeach
            </ul>
        </div>
    </div>

@endforeach

{{ $holdings->links('pagination::bootstrap-5') }}