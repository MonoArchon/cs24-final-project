
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-4">
        <h2>{{ $target->name }}</h2>
        <a href="{{ route('targets.edit', $target) }}" class="btn btn-warning">
            Edit Target
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Base URL:</strong> {{ $target->base_url }}</p>
            <p><strong>Description:</strong> {{ $target->description ?: 'No description' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($target->status) }}</p>
        </div>
    </div>

    
    <div class="d-flex justify-content-between mb-3">
        <h4>Authorized Scope</h4>

        <a href="{{ route('targets.scopes.create', $target) }}"
        class="btn btn-primary">
            + Add Scope
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Type</th>
                        <th>Scope Status</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($target->scopes as $scope)
                        <tr>
                            <td>{{ $scope->asset }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $scope->asset_type)) }}</td>
                            <td>
                                @if($scope->scope_status === 'in_scope')
                                    <span class="badge bg-success">In Scope</span>
                                @else
                                    <span class="badge bg-danger">Out of Scope</span>
                                @endif
                            </td>
                            <td>{{ $scope->notes ?: '—' }}</td>
                            <td>
                                <a href="{{ route('targets.scopes.edit', [$target, $scope]) }}"
                                class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('targets.scopes.destroy', [$target, $scope]) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this scope asset?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No scope assets registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="card">
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Type</th>
                        <th>Scope Status</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($target->scopes as $scope)
                        <tr>
                            <td>{{ $scope->asset }}</td>
                            <td>{{ ucfirst($scope->asset_type) }}</td>
                            <td>{{ str_replace('_', ' ', ucfirst($scope->scope_status)) }}</td>
                            <td>{{ $scope->notes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No scope assets registered.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
