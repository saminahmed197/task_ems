<form action="{{ route('admin.clients.approve') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td><input type="checkbox" name="client_ids[]" value="{{ $client->id }}"></td>
                        <td><input type="text" name="names[{{ $client->id }}]" value={{ $client->name }} style="border: none; background: transparent; outline: none; width: 100%;"> </td>
                        <td><input type="text" name="emails[{{ $client->id }}]" value={{ $client->email }} style="border: none; background: transparent; outline: none; width: 100%;"></td>
                        <td><input type="text" name="phones[{{ $client->id }}]" value={{ $client->phone }} style="border: none; background: transparent; outline: none; width: 100%;"></td>
                        <td>
                            @if($client->request_decision === 'NO')
                                <select name="role[{{ $client->id }}]" class="form-select">
                                    <option value="3" <?php if($client->request_role == 3) echo 'selected';?>>Client</option>
                                    <option value="0" <?php if($client->request_role == 0) echo 'selected';?>>Manager</option>
                                    <option value="2" <?php if($client->request_role == 2) echo 'selected';?>>Analyst</option>
                                </select>
                            @elseif($client->request_decision === 'YES')
                                @php
                                    $roleName = match($client->request_role) {
                                        0 => 'Manager',
                                        2 => 'Analyst',
                                        3 => 'Client',
                                        default => 'Unknown',
                                    };
                                @endphp
                                <span class="badge bg-primary">{{ $roleName }}</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <select name="status[{{ $client->id }}]" class="form-select" required>
                                <option value="Y" <?php if($client->is_active === 'Y') echo 'selected';?>>Active</option>
                                <option value="N" <?php if($client->is_active === 'N') echo 'selected';?>>De-active</option>
                            </select>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No clients found.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <div>{{ $clients->links('pagination::bootstrap-5') }}</div>
        </div>
    </form>