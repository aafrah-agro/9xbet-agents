@extends('layouts.public')

@section('title', $setting->meta_title)
@section('meta_description', $setting->meta_description)

@section('content')

@php
$sections = [
    [
        'label'    => 'ভেরিফাইড সুপার এজেন্ট লিস্ট',
        'label_en' => 'Verified Super Agents',
        'icon'     => 'fa-crown',
        'agents'   => $superAgents,
        'has_complaint' => $superAgents->contains(fn($a)=>$a->complaint_number),
    ],
    [
        'label'    => 'ভেরিফাইড এজেন্ট লিস্ট',
        'label_en' => 'Verified Agents',
        'icon'     => 'fa-user-tie',
        'agents'   => $agents,
        'has_complaint' => $agents->contains(fn($a)=>$a->complaint_number),
    ],
    [
        'label'    => 'এডমিন লিস্ট',
        'label_en' => 'Admin List',
        'icon'     => 'fa-shield-halved',
        'agents'   => $admins,
        'has_complaint' => $admins->contains(fn($a)=>$a->complaint_number),
    ],
    [
        'label'    => 'কাস্টমার সার্ভিস / হেল্পলাইন',
        'label_en' => 'Customer Service',
        'icon'     => 'fa-headset',
        'agents'   => $customerService,
        'has_complaint' => $customerService->contains(fn($a)=>$a->complaint_number),
    ],
];
@endphp

@foreach($sections as $sec)
@if($sec['agents']->count())

<div class="sec-header">
    <h2>
        <i class="fas {{ $sec['icon'] }}"></i>
        {{ $sec['label'] }}
        <span style="font-size:.72rem;opacity:.75;font-weight:500">({{ $sec['label_en'] }})</span>
    </h2>
    <span class="count">{{ $sec['agents']->count() }} জন</span>
    <button class="btn-shuffle" onclick="shuffleTable(this)" title="র্যান্ডমলি সাজান">
        <i class="fas fa-shuffle"></i> র্যান্ডম
    </button>
</div>

<div class="tbl-wrap">
    <table>
        <thead>
            <tr>
                <th class="th-num">ক্রমিক</th>
                <th>এজেন্ট আইডি</th>
                <th>নাম</th>
                <th>হোয়াটসঅ্যাপ</th>
                @if($sec['has_complaint'])
                <th>অভিযোগ নম্বর</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($sec['agents'] as $i => $agent)
            <tr>
                <td class="td-num">{{ $i + 1 }}</td>
                <td><span class="agent-id">{{ $agent->agent_id }}</span></td>
                <td class="agent-name" style="text-align:left">{{ $agent->name }}</td>
                <td>
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$agent->whatsapp_number) }}"
                       class="btn-wa" target="_blank" rel="nofollow noopener">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </td>
                @if($sec['has_complaint'])
                <td>
                    @if($agent->complaint_number)
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$agent->complaint_number) }}"
                       class="btn-contact" target="_blank" rel="nofollow noopener">
                        <i class="fas fa-phone"></i> যোগাযোগ
                    </a>
                    @else
                    <span style="color:#ccc">—</span>
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif
@endforeach

@endsection
