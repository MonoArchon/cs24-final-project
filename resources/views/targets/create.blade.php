
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Register New Target</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('targets.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Target Name</label>
                    <input type="text" name="name"
                           class="form-control" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Base URL or Host</label>
                    <input type="text" name="base_url"
                           class="form-control"
                           placeholder="https://example.com"
                           value="{{ old('base_url') }}" required>
                    @error('base_url') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary">Save Target</button>
                <a href="{{ route('targets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
