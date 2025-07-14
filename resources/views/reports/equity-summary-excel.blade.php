<table>
    <thead>
        <tr>
            <th>Clients</th>
            <th>Stock</th>
            <th>Sector</th>
            <th>Quantity</th>
            <th>Buy Price</th>
            <th>Current Price</th>
            <th>Total Value</th>
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
                <td>{{ number_format($holding->quantity * ($holding->current_price ?? 0), 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
