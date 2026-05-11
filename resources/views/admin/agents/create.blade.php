@extends('layouts.admin')
@section('title', 'Add Agent')

@section('content')
<div class="card" style="max-width:680px">
    <div class="card-header">
        <h2><i class="fas fa-user-plus" style="color:var(--primary)"></i> Add New Agent</h2>
        <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.agents.store') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Agent ID *</label>
                <input type="text" name="agent_id" class="form-control" value="{{ old('agent_id') }}"
                       placeholder="e.g. 9X-1001" required>
                @error('agent_id')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Type *</label>
                <select name="type" class="form-control" required>
                    <option value="">Select type...</option>
                    @foreach($types as $t)
                    <option value="{{ $t }}" @selected(old('type') === $t)>{{ $t }}</option>
                    @endforeach
                </select>
                @error('type')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>WhatsApp Number *</label>
                <input type="text" name="whatsapp_number" class="form-control"
                       value="{{ old('whatsapp_number') }}" placeholder="880XXXXXXXXXX" required>
                @error('whatsapp_number')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Complaint Number</label>
                <input type="text" name="complaint_number" class="form-control"
                       value="{{ old('complaint_number') }}" placeholder="Optional">
                @error('complaint_number')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:16px">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
                    Active (visible on site)
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Agent</button>
            <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
