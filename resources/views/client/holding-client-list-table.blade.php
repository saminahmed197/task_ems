@foreach($holdings as $holding)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between align-items-center">
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
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editHoldingModal{{ $holding->id }}">
                Edit
            </button>
            <form action="{{ route('admin.clientholdingsdelete.list', $holding->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this holding?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
<!-- Edit Modal -->
<div class="modal fade" id="editHoldingModal{{ $holding->id }}" tabindex="-1" aria-labelledby="editLabel{{ $holding->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.clientholdingsupdate.list', $holding->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Holding for {{ $holding->company_name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row">
            <div class="mb-3 col-md-6">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" value="{{ $holding->company_name }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Stock Symbol</label>
                <input type="text" name="stock_symbol" class="form-control" value="{{ $holding->stock_symbol }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $holding->quantity }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Buy Price</label>
                <input type="text" name="buy_price" class="form-control" value="{{ $holding->buy_price }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label">Purchase Date</label>
                <input type="date" name="purchase_date" class="form-control" value="{{ $holding->purchase_date }}" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="sector" class="form-label">Select Sector</label>
                <select name="sector" id="sector" class="form-control">
                    <option value="">-- ALL SECTORS --</option>
                    <option value="TECHNOLOGY" <?php if($holding->sector == 'TECHNOLOGY') echo 'selected';?>>Technology</option>
                    <option value="HEALTHCARE" <?php if($holding->sector == 'HEALTHCARE') echo 'selected';?>>Healthcare</option>
                    <option value="FINANCIALS" <?php if($holding->sector == 'FINANCIALS') echo 'selected';?>>Financials</option> 
                    <option value="ENERGY" <?php if($holding->sector == 'ENERGY') echo 'selected';?>>Energy</option>
                    <option value="CONSUMER DISCRETIONARY" <?php if($holding->sector == 'CONSUMER DISCRETIONARY') echo 'selected';?>>Consumer Discretionary</option>
                    <option value="CONSUMER STAPLES" <?php if($holding->sector == 'CONSUMER STAPLES') echo 'selected';?>>Consumer Staples</option>
                    <option value="INDUSTRIALS" <?php if($holding->sector == 'INDUSTRIALS') echo 'selected';?>>Industrials</option>
                    <option value="UTILITIES" <?php if($holding->sector == 'UTILITIES') echo 'selected';?>>Utilities</option>
                    <option value="REAL ESTATE" <?php if($holding->sector == 'REAL ESTATE') echo 'selected';?>>Real Estate</option>
                    <option value="COMMUNICATION" <?php if($holding->sector == 'COMMUNICATION') echo 'selected';?>>Communication</option>
                    <option value="MATERIALS" <?php if($holding->sector == 'MATERIALS') echo 'selected';?>>Materials</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Clients</label>
                <select class="form-select" name="user_ids[]" multiple required>
                    @foreach($all_clients as $client)
                        <option value="{{ $client->id }}"
                            @if($holding->users->contains($client->id)) selected @endif>
                            {{ $client->name }} ({{ $client->email }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple clients</small>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Holding</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach



{{ $holdings->links('pagination::bootstrap-5') }}
