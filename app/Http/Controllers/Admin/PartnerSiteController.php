<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerSite;
use Illuminate\Http\Request;

class PartnerSiteController extends Controller
{
    public function index()
    {
        $partners = PartnerSite::orderBy('sort_order')->get();
        return view('admin.partner-sites.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partner-sites.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'url'         => ['required', 'url'],
            'description' => ['nullable', 'string', 'max:200'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['boolean'],
        ]);
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        PartnerSite::create($data);
        return redirect()->route('admin.partner-sites.index')->with('success', 'Partner site added.');
    }

    public function show(string $id) { abort(404); }

    public function edit(PartnerSite $partnerSite)
    {
        return view('admin.partner-sites.edit', compact('partnerSite'));
    }

    public function update(Request $request, PartnerSite $partnerSite)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'url'         => ['required', 'url'],
            'description' => ['nullable', 'string', 'max:200'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['boolean'],
        ]);
        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $partnerSite->update($data);
        return redirect()->route('admin.partner-sites.index')->with('success', 'Partner site updated.');
    }

    public function destroy(PartnerSite $partnerSite)
    {
        $partnerSite->delete();
        return back()->with('success', 'Partner site deleted.');
    }
}
