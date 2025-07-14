@extends('layout/navbar-layout')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('space-work')
<div class="container mt-5">
    <h2>Clients & Holdings</h2>
    
    @foreach($clients as $client)
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $client->name }}</strong><br>
                    Email: {{ $client->email }}<br>
                    Phone: {{ $client->phone }}
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHoldingModal{{ $client->id }}">
                    Add Holding
                </button>
                
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addHoldingModal{{ $client->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $client->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form action="{{ route('admin.clientholdingsstore.list') }}" method="POST">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel{{ $client->id }}">Add Holding for {{ $client->name }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="user_id" value="{{ $client->id }}">
                    
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Stock Symbol</label>
                        <input type="text" class="form-control" name="stock_symbol" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Buy Price</label>
                        <input type="text" class="form-control" name="buy_price" required>
                        <div id="buyPriceError" class="text-danger mt-1"></div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="sector" class="form-label">Select Sector</label>
                        <select name="sector" id="sector" class="form-control">
                            <option value="">-- All Sectors --</option>
                            <option value="TECHNOLOGY">Technology</option>
                            <option value="HEALTHCARE">Healthcare</option>
                            <option value="FINANCIALS">Financials</option>
                            <option value="ENERGY">Energy</option>
                            <option value="CONSUMER DISCRETIONARY">Consumer Discretionary</option>
                            <option value="CONSUMER STAPLES">Consumer Staples</option>
                            <option value="INDUSTRIALS">Industrials</option>
                            <option value="UTILITIES">Utilities</option>
                            <option value="REAL ESTATE">Real Estate</option>
                            <option value="COMMUNICATION">Communication</option>
                            <option value="MATERIALS">Materials</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Add More Clients to this Holding</label>
                        <select class="form-select" name="additional_user_ids[]" multiple>
                            @foreach($all_clients as $other)
                                @if($other->id != $client->id)
                                    <option value="{{ $other->id }}">{{ $other->name }} ({{ $other->email }})</option>
                                @endif
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple clients</small>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Save Holding</button>
                </div>
                
                    
            
              </form>
            </div>
          </div>
        </div>
    @endforeach
    <div>{{ $clients->links('pagination::bootstrap-5') }}</div>
</div>

<script>
    // Target all buy_price fields dynamically
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const buyPriceInput = form.querySelector('input[name="buy_price"]');
            const errorDiv = form.querySelector('#buyPriceError');
            const value = buyPriceInput.value;
            const regex = /^\d*\.?\d{0,2}$/;

            if (!regex.test(value)) {
                e.preventDefault(); // prevent form from submitting
                errorDiv.textContent = "Only numbers and one dot allowed";
                buyPriceInput.classList.add('is-invalid');
            } else {
                errorDiv.textContent = "";
                buyPriceInput.classList.remove('is-invalid');
            }
        });
    });
</script>


@endsection
