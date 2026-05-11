<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $type   = $request->input('type');
        $search = $request->input('search');

        $query = Agent::orderBy('type')->orderBy('sort_order');

        if ($type) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('agent_id', 'like', "%{$search}%");
            });
        }

        $agents = $query->paginate(25)->withQueryString();
        $types  = Agent::$types;

        return view('admin.agents.index', compact('agents', 'types', 'type', 'search'));
    }

    public function create()
    {
        $types = Agent::$types;
        return view('admin.agents.create', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'agent_id'         => ['required', 'string', 'unique:agents,agent_id'],
            'name'             => ['required', 'string', 'max:255'],
            'whatsapp_number'  => ['required', 'string', 'max:20'],
            'complaint_number' => ['nullable', 'string', 'max:20'],
            'type'             => ['required', 'in:' . implode(',', Agent::$types)],
            'sort_order'       => ['nullable', 'integer'],
            'is_active'        => ['boolean'],
        ]);

        $data['is_active']   = $request->boolean('is_active', true);
        $data['sort_order']  = $data['sort_order'] ?? 0;

        Agent::create($data);

        return redirect()->route('admin.agents.index')->with('success', 'Agent added successfully.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(Agent $agent)
    {
        $types = Agent::$types;
        return view('admin.agents.edit', compact('agent', 'types'));
    }

    public function update(Request $request, Agent $agent)
    {
        $data = $request->validate([
            'agent_id'         => ['required', 'string', 'unique:agents,agent_id,' . $agent->id],
            'name'             => ['required', 'string', 'max:255'],
            'whatsapp_number'  => ['required', 'string', 'max:20'],
            'complaint_number' => ['nullable', 'string', 'max:20'],
            'type'             => ['required', 'in:' . implode(',', Agent::$types)],
            'sort_order'       => ['nullable', 'integer'],
            'is_active'        => ['boolean'],
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $agent->update($data);

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return back()->with('success', 'Agent deleted.');
    }
}
