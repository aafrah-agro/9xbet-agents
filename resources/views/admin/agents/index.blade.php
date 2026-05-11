@extends('layouts.admin')
@section('title', 'Agents')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-users" style="color:var(--primary)"></i> Agent List</h2>
        <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Agent
        </a>
    </div>

    {{-- FILTERS --}}
    <form method="GET" style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px">
        <select name="type" class="form-control" style="width:auto" onchange="this.form.submit()">
            <option value="">All Types</option>
            @foreach($types as $t)
            <option value="{{ $t }}" @selected($type === $t)>{{ $t }}</option>
            @endforeach
        </select>
        <input type="text" name="search" value="{{ $search }}" placeholder="Search name / ID..." class="form-control" style="max-width:200px">
        <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
        @if($type || $search)
        <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-xmark"></i> Clear</a>
        @endif
    </form>

    <div class="tbl-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Agent ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>WhatsApp</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agents as $agent)
                <tr>
                    <td style="color:var(--muted);font-size:.75rem">{{ $agents->firstItem() + $loop->index }}</td>
                    <td style="font-family:monospace;color:var(--primary);font-weight:700">{{ $agent->agent_id }}</td>
                    <td>{{ $agent->name }}</td>
                    <td>
                        @php
                            $bc = ['Admin'=>'badge-admin','Super Agent'=>'badge-super','Agent'=>'badge-agent','Customer Service'=>'badge-cs'];
                        @endphp
                        <span class="badge {{ $bc[$agent->type] ?? '' }}">{{ $agent->type }}</span>
                    </td>
                    <td style="font-size:.8rem">{{ $agent->whatsapp_number }}</td>
                    <td>
                        <span class="badge {{ $agent->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $agent->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.agents.edit', $agent) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.agents.destroy', $agent) }}"
                                  onsubmit="return confirm('Delete {{ $agent->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--muted);padding:30px">
                        No agents found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($agents->hasPages())
    <div class="pagination">
        {!! $agents->links('pagination::simple-default') !!}
    </div>
    @endif
</div>
@endsection
