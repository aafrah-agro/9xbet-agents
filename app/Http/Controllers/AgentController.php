<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\PartnerSite;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $setting  = Setting::get();
        $socials  = SocialLink::where('is_active', true)->orderBy('sort_order')->get();
        $partners = PartnerSite::where('is_active', true)->orderBy('sort_order')->get();

        $superAgents     = Agent::active()->ofType('Super Agent')->orderBy('sort_order')->get();
        $agents          = Agent::active()->ofType('Agent')->orderBy('sort_order')->get();
        $admins          = Agent::active()->ofType('Admin')->orderBy('sort_order')->get();
        $customerService = Agent::active()->ofType('Customer Service')->orderBy('sort_order')->get();

        return view('welcome', compact('setting', 'socials', 'partners', 'superAgents', 'agents', 'admins', 'customerService'));
    }

    public function byType(Request $request, string $type)
    {
        $typeMap = [
            'super-agent'     => 'Super Agent',
            'agent'           => 'Agent',
            'admin'           => 'Admin',
            'customer-service'=> 'Customer Service',
        ];

        $agentType = $typeMap[$type] ?? abort(404);
        $setting  = Setting::get();
        $socials  = SocialLink::where('is_active', true)->orderBy('sort_order')->get();
        $partners = PartnerSite::where('is_active', true)->orderBy('sort_order')->get();

        $search = $request->input('search');
        $agentsQuery = Agent::active()->ofType($agentType)->orderBy('sort_order');

        if ($search) {
            $agentsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('agent_id', 'like', "%{$search}%")
                  ->orWhere('whatsapp_number', 'like', "%{$search}%");
            });
        }

        $agentsList = $agentsQuery->get();

        return view('agents.list', compact('setting', 'socials', 'partners', 'agentsList', 'agentType', 'search'));
    }
}
