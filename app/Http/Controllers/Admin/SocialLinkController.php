<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::orderBy('sort_order')->get();
        return view('admin.social-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform'   => ['required', 'string', 'max:50'],
            'url'        => ['required', 'url'],
            'icon'       => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['boolean'],
        ]);

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        SocialLink::create($data);

        return redirect()->route('admin.social-links.index')->with('success', 'Social link added.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $data = $request->validate([
            'platform'   => ['required', 'string', 'max:50'],
            'url'        => ['required', 'url'],
            'icon'       => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'is_active'  => ['boolean'],
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $socialLink->update($data);

        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return back()->with('success', 'Social link deleted.');
    }
}
