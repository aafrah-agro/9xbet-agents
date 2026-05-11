@extends('layouts.admin')
@section('title', 'Site Settings')

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header">
        <h2><i class="fas fa-sliders" style="color:var(--primary)"></i> Site Settings</h2>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Site Name *</label>
            <input type="text" name="site_name" class="form-control"
                   value="{{ old('site_name', $setting->site_name) }}" required>
            @error('site_name')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Meta Title * <small style="color:var(--muted)">(max 160 chars)</small></label>
            <input type="text" name="meta_title" class="form-control"
                   value="{{ old('meta_title', $setting->meta_title) }}" maxlength="160" required>
            @error('meta_title')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Meta Description * <small style="color:var(--muted)">(max 320 chars)</small></label>
            <textarea name="meta_description" class="form-control" rows="3"
                      maxlength="320" required>{{ old('meta_description', $setting->meta_description) }}</textarea>
            @error('meta_description')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Meta Keywords <small style="color:var(--muted)">(comma separated)</small></label>
            <input type="text" name="meta_keywords" class="form-control"
                   value="{{ old('meta_keywords', $setting->meta_keywords) }}"
                   placeholder="9xbet, agent list, bangladesh">
            @error('meta_keywords')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>Canonical URL <small style="color:var(--muted)">(optional, e.g. https://yourdomain.com)</small></label>
            <input type="url" name="canonical_url" class="form-control"
                   value="{{ old('canonical_url', $setting->canonical_url) }}"
                   placeholder="https://yourdomain.com">
            @error('canonical_url')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="form-group">
            <label>
                টিকার / নোটিশ বার
                <small style="color:var(--muted)">(স্ক্রলিং টিকার — বাংলায় লিখুন — খালি রাখলে দেখাবে না)</small>
            </label>
            <textarea name="notice" class="form-control" rows="2"
                   placeholder="উদাহরণ: ৯এক্সবেটে স্বাগতম! অফার: প্রতিদিন বোনাস পাচ্ছেন ✅ নতুন একাউন্ট খুলুন আজই!">{{ old('notice', $setting->notice) }}</textarea>
            @error('notice')<div class="err">{{ $message }}</div>@enderror
            <small style="color:var(--muted);font-size:.72rem">💡 অফার, নিউজ ও প্রমোশন এখানে লিখুন — সাইটের উপরে স্ক্রল করে দেখাবে</small>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
    </form>
</div>
@endsection
