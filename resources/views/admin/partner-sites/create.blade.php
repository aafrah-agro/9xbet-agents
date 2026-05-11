@extends('layouts.admin')
@section('title', 'Add Partner Site')

@section('content')
<div class="card" style="max-width:560px">
    <div class="card-header">
        <h2><i class="fas fa-plus" style="color:var(--primary)"></i> Add Partner Site</h2>
        <a href="{{ route('admin.partner-sites.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <form method="POST" action="{{ route('admin.partner-sites.store') }}">
        @csrf
        <div class="form-group">
            <label>Site Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Official Velki" required>
            @error('name')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>URL *</label>
            <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="https://example.com" required>
            @error('url')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Description <small style="color:var(--muted)">(shown as tooltip)</small></label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Optional short description">
            @error('description')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:16px">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
                    Active (show on site)
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
    </form>
</div>
@endsection
