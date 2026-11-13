
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Target</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('targets.update', $target) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Target Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $target->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Base URL or Host</label>
                    <input type="text" name="base_url" class="form-control"
                           value="{{ old('base_url', $target->base_url) }}" required>
                    @error('base_url') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $target->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" @selected($target->status === 'active')>Active</option>
                        <option value="inactive" @selected($target->status === 'inactive')>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-primary">Update Target</button>
                <a href="{{ route('targets.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
