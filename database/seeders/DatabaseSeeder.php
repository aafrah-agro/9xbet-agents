<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\PartnerSite;
use App\Models\Setting;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@9xbet.com'], [
            'name'     => '9XBET Admin',
            'password' => Hash::make('Admin@9xbet2026'),
        ]);

        Setting::get();

        $agents = [
            ['agent_id' => '9X-SA-001', 'name' => 'Rahim Super Agent', 'whatsapp_number' => '8801700000001', 'type' => 'Super Agent', 'sort_order' => 1],
            ['agent_id' => '9X-SA-002', 'name' => 'Karim Super Agent', 'whatsapp_number' => '8801700000002', 'type' => 'Super Agent', 'sort_order' => 2],
            ['agent_id' => '9X-AG-001', 'name' => 'Salam Agent',      'whatsapp_number' => '8801800000001', 'type' => 'Agent',       'sort_order' => 1],
            ['agent_id' => '9X-AG-002', 'name' => 'Babu Agent',       'whatsapp_number' => '8801800000002', 'type' => 'Agent',       'sort_order' => 2],
            ['agent_id' => '9X-AD-001', 'name' => 'Main Admin',       'whatsapp_number' => '8801900000001', 'complaint_number' => '8801900000002', 'type' => 'Admin', 'sort_order' => 1],
            ['agent_id' => '9X-CS-001', 'name' => 'Helpline 01',      'whatsapp_number' => '8801600000001', 'type' => 'Customer Service', 'sort_order' => 1],
        ];

        foreach ($agents as $a) {
            Agent::firstOrCreate(['agent_id' => $a['agent_id']], array_merge($a, ['is_active' => true]));
        }

        $socials = [
            ['platform' => 'Telegram',  'url' => 'https://t.me/9xbetbd',                      'icon' => 'fab fa-telegram',   'sort_order' => 1],
            ['platform' => 'Facebook',  'url' => 'https://www.facebook.com/groups/velkibet',   'icon' => 'fab fa-facebook-f', 'sort_order' => 2],
            ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/velki_id/',        'icon' => 'fab fa-instagram',  'sort_order' => 3],
            ['platform' => 'YouTube',   'url' => 'https://www.youtube.com/@VELKI365BET',       'icon' => 'fab fa-youtube',    'sort_order' => 4],
            ['platform' => 'X',         'url' => 'https://x.com/VelkiL71425',                 'icon' => 'fab fa-x-twitter',  'sort_order' => 5],
        ];

        foreach ($socials as $s) {
            SocialLink::firstOrCreate(['platform' => $s['platform']], array_merge($s, ['is_active' => true]));
        }

        $partnerSites = [
            ['name' => 'Official Velki',     'url' => 'https://officialvelki.com',    'description' => 'Official Velki Agent List',   'sort_order' => 1],
            ['name' => 'Velki Agent List',   'url' => 'https://velkieagent.com',      'description' => 'Velki Agent Directory',        'sort_order' => 2],
            ['name' => 'Velki365 AgentList', 'url' => 'https://velkie365agent.com',   'description' => 'Velki365 Agent Directory',     'sort_order' => 3],
            ['name' => 'AgentList VIP',      'url' => 'https://agentlist.vip',        'description' => 'VIP Agent List',               'sort_order' => 4],
            ['name' => 'Velki 365',          'url' => 'https://velkie365.com',        'description' => 'Velki 365 Official',           'sort_order' => 5],
            ['name' => 'Velki App',          'url' => 'https://velkie365.live',       'description' => 'Velki App Live',               'sort_order' => 6],
        ];

        foreach ($partnerSites as $p) {
            PartnerSite::firstOrCreate(['name' => $p['name']], array_merge($p, ['is_active' => true]));
        }
    }
}
