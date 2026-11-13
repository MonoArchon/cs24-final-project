
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Scope Asset</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Target:</strong> {{ $target->name }}</p>

            <form action="{{ route('targets.scopes.update', [$target, $scope]) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Asset</label>
                    <input type="text"
                           name="asset"
                           class="form-control"
                           value="{{ old('asset', $scope->asset) }}"
                           required>
                    @error('asset')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Asset Type</label>
                    <select name="asset_type" class="form-select">
                        <option value="domain"
                            @selected(old('asset_type', $scope->asset_type) === 'domain')>
                            Domain
                        </option>
                        <option value="url"
                            @selected(old('asset_type', $scope->asset_type) === 'url')>
                            URL
                        </option>
                        <option value="ip_address"
                            @selected(old('asset_type', $scope->asset_type) === 'ip_address')>
                            IP Address
                        </option>
                    </select>
                    @error('asset_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Scope Status</label>
                    <select name="scope_status" class="form-select">
                        <option value="in_scope"
                            @selected(old('scope_status', $scope->scope_status) === 'in_scope')>
                            In Scope
                        </option>
                        <option value="out_of_scope"
                            @selected(old('scope_status', $scope->scope_status) === 'out_of_scope')>
                            Out of Scope
                        </option>
                    </select>
                    @error('scope_status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes"
                              class="form-control"
                              rows="3">{{ old('notes', $scope->notes) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Scope
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
