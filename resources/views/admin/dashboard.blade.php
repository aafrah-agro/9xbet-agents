@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="stats">
    <div class="stat-card">
        <div class="val">{{ $total }}</div>
        <div class="lbl">Total Agents</div>
    </div>
    @foreach($byType as $row)
    <div class="stat-card">
        <div class="val">{{ $row->count }}</div>
        <div class="lbl">{{ $row->type }}</div>
    </div>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-bolt" style="color:var(--primary)"></i> Quick Actions</h2>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="{{ route('admin.agents.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New Agent
        </a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">
            <i class="fas fa-eye"></i> View Site
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="btn btn-secondary">
            <i class="fas fa-sliders"></i> Settings
        </a>
    </div>
</div>
@endsection
