@extends('layouts.admin')
@section('title', 'Edit Social Link')

@section('content')
<div class="card" style="max-width:560px">
    <div class="card-header">
        <h2><i class="fas fa-pen" style="color:var(--primary)"></i> Edit Social Link</h2>
        <a href="{{ route('admin.social-links.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <form method="POST" action="{{ route('admin.social-links.update', $socialLink) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Platform *</label>
            <input type="text" name="platform" class="form-control"
                   value="{{ old('platform', $socialLink->platform) }}" required>
            @error('platform')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>URL *</label>
            <input type="url" name="url" class="form-control"
                   value="{{ old('url', $socialLink->url) }}" required>
            @error('url')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Font Awesome Icon Class *</label>
            <input type="text" name="icon" class="form-control"
                   value="{{ old('icon', $socialLink->icon) }}" required>
            @error('icon')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="{{ old('sort_order', $socialLink->sort_order) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:16px">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1"
                           @checked(old('is_active', $socialLink->is_active))>
                    Active
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
    </form>
</div>
@endsection
