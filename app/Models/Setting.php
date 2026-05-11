<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'site_name',
        'logo',
        'favicon',
        'notice',
        'canonical_url',
    ];

    public static function get(): self
    {
        return static::firstOrCreate([], [
            'meta_title' => '9XBET Agent List Bangladesh 2026 | Official Verified Agents',
            'meta_description' => 'Official 9XBET Bangladesh agent list. Find verified super agents, master agents and customer service contacts. Safe & trusted.',
            'meta_keywords' => '9xbet agent list, 9xbet bangladesh, 9xbet super agent, 9xbet master agent',
            'site_name' => '9XBET Agent List Bangladesh',
            'notice' => null,
            'canonical_url' => null,
        ]);
    }
}
