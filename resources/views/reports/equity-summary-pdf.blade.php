<!DOCTYPE html>
<html>
<head>
    <title>Equity Summary</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Equity Summary Report</h3>

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
</body>
</html>
