
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Authorized Scope</h2>

    <div class="card">
        <div class="card-body">
            <p>
                <strong>Target:</strong> {{ $target->name }}
            </p>

            <form action="{{ route('targets.scopes.store', $target) }}"
                  method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Asset</label>
                    <input type="text"
                           name="asset"
                           class="form-control"
                           value="{{ old('asset') }}"
                           placeholder="example.com"
                           required>
                    @error('asset')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Asset Type</label>
                    <select name="asset_type" class="form-select" required>
                        <option value="domain">Domain</option>
                        <option value="url">URL</option>
                        <option value="ip_address">IP Address</option>
                    </select>
                    @error('asset_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Scope Status</label>
                    <select name="scope_status" class="form-select" required>
                        <option value="in_scope">In Scope</option>
                        <option value="out_of_scope">Out of Scope</option>
                    </select>
                    @error('scope_status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes"
                              class="form-control"
                              rows="3">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Scope
                </button>

                <a href="{{ route('targets.show', $target) }}"
                   class="btn btn-secondary">
                    Cancel
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
