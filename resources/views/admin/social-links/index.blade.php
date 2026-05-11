@extends('layouts.admin')
@section('title', 'Social Links')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-share-nodes" style="color:var(--primary)"></i> Social Links</h2>
        <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Link
        </a>
    </div>
    <div class="tbl-wrap">
        <table>
            <thead>
                <tr>
                    <th>Platform</th>
                    <th>Icon Class</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($links as $link)
                <tr>
                    <td>
                        <i class="{{ $link->icon }}" style="color:var(--primary);margin-right:6px"></i>
                        {{ $link->platform }}
                    </td>
                    <td style="font-family:monospace;font-size:.78rem;color:var(--muted)">{{ $link->icon }}</td>
                    <td style="font-size:.78rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                        {{ $link->url }}
                    </td>
                    <td>{{ $link->sort_order }}</td>
                    <td>
                        <span class="badge {{ $link->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $link->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.social-links.edit', $link) }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.social-links.destroy', $link) }}"
                                  onsubmit="return confirm('Delete this link?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--muted);padding:30px">
                        No social links yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
