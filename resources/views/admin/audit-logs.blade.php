@extends('layout/navbar-layout')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('space-work')
<div class="container">
    <h4 class="mb-4">Audit Log History</h4>
    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Role</th>
                <th>Log Type</th>
                <th>Module</th>
                <th>Description</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                    <td>
                        @php
                            $role = match($log->user->is_admin ?? null) {
                                1 => 'Admin',
                                0 => 'Manager',
                                2 => 'Analyst',
                                3 => 'Client',
                                default => 'Unknown',
                            };
                        @endphp
                        {{ $role }}
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $log->log_type }}</span></td>
                    <td>{{ $log->impact_module }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No logs found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $logs->links() }}
    </div>
</div>
@endsection
