@extends('layouts.admin')
@section('title', 'Partner Sites')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-handshake" style="color:var(--primary)"></i> Partner Sites</h2>
        <a href="{{ route('admin.partner-sites.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Partner
        </a>
    </div>
    <div class="tbl-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Description</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $p)
                <tr>
                    <td style="font-weight:700">{{ $p->name }}</td>
                    <td style="font-size:.78rem;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $p->url }}</td>
                    <td style="font-size:.78rem;color:var(--muted)">{{ $p->description ?? '—' }}</td>
                    <td>{{ $p->sort_order }}</td>
                    <td>
                        <span class="badge {{ $p->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $p->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.partner-sites.edit', $p) }}" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i></a>
                            <form method="POST" action="{{ route('admin.partner-sites.destroy', $p) }}"
                                  onsubmit="return confirm('Delete {{ $p->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--muted);padding:30px">No partner sites yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
