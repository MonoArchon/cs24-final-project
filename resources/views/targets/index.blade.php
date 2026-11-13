
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Targets</h2>
        <a href="{{ route('targets.create') }}" class="btn btn-primary">
            + Register Target
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
                        <th>Name</th>
                        <th>Base URL</th>
                        <th>Status</th>
                        <th>Scopes</th>
                        <th>Assessments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($targets as $target)
                        <tr>
                            <td>{{ $target->name }}</td>
                            <td>{{ $target->base_url }}</td>
                            <td>{{ ucfirst($target->status) }}</td>
                            <td>{{ $target->scopes_count }}</td>
                            <td>{{ $target->assessments_count }}</td>
                            <td>
                                <a href="{{ route('targets.show', $target) }}"
                                   class="btn btn-sm btn-info">View</a>

                                <a href="{{ route('targets.edit', $target) }}"
                                   class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('targets.destroy', $target) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this target?')">
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
                            <td colspan="6" class="text-center">
                                No targets registered yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $targets->links() }}
        </div>
    </div>
</div>
@endsection
