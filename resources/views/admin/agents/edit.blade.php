@extends('layouts.admin')
@section('title', 'Edit Agent')

@section('content')
<div class="card" style="max-width:680px">
    <div class="card-header">
        <h2><i class="fas fa-pen" style="color:var(--primary)"></i> Edit Agent — {{ $agent->agent_id }}</h2>
        <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.agents.update', $agent) }}">
        @csrf @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label>Agent ID *</label>
                <input type="text" name="agent_id" class="form-control"
                       value="{{ old('agent_id', $agent->agent_id) }}" required>
                @error('agent_id')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Type *</label>
                <select name="type" class="form-control" required>
                    @foreach($types as $t)
                    <option value="{{ $t }}" @selected(old('type', $agent->type) === $t)>{{ $t }}</option>
                    @endforeach
                </select>
                @error('type')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $agent->name) }}" required>
            @error('name')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>WhatsApp Number *</label>
                <input type="text" name="whatsapp_number" class="form-control"
                       value="{{ old('whatsapp_number', $agent->whatsapp_number) }}" required>
                @error('whatsapp_number')<div class="err">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Complaint Number</label>
                <input type="text" name="complaint_number" class="form-control"
                       value="{{ old('complaint_number', $agent->complaint_number) }}">
                @error('complaint_number')<div class="err">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="{{ old('sort_order', $agent->sort_order) }}">
            </div>
            <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:16px">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1"
                           @checked(old('is_active', $agent->is_active))>
                    Active (visible on site)
                </label>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Agent</button>
            <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
