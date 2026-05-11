<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::get();
        return view('admin.settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'meta_title'       => ['required', 'string', 'max:160'],
            'meta_description' => ['required', 'string', 'max:320'],
            'meta_keywords'    => ['nullable', 'string', 'max:255'],
            'site_name'        => ['required', 'string', 'max:100'],
            'notice'           => ['nullable', 'string'],
            'canonical_url'    => ['nullable', 'url'],
        ]);

        Setting::get()->update($data);

        return back()->with('success', 'Settings saved.');
    }
}
