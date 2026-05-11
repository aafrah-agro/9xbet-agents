@extends('layouts.public')

@php
$labelMap = [
    'Super Agent'      => 'সুপার এজেন্ট লিস্ট',
    'Agent'            => 'এজেন্ট লিস্ট',
    'Admin'            => 'এডমিন লিস্ট',
    'Customer Service' => 'কাস্টমার সার্ভিস / হেল্পলাইন',
];
$labelBn = $labelMap[$agentType] ?? $agentType;
@endphp

@section('title', $labelBn . ' | ' . $setting->site_name)
@section('meta_description', 'বাংলাদেশের অফিসিয়াল ৯এক্সবেট ' . $labelBn . '। ভেরিফাইড এজেন্টদের হোয়াটসঅ্যাপ নম্বর সহ তালিকা।')

@section('content')

<form method="GET" action="" class="search-wrap">
    <input type="text" name="search" value="{{ $search }}"
           placeholder="নাম, আইডি বা নম্বর দিয়ে খুঁজুন...">
    <button type="submit"><i class="fas fa-search"></i> খুঁজুন</button>
    @if($search)
    <button type="button" class="btn-clear" onclick="location.href='{{ request()->url() }}'">
        <i class="fas fa-xmark"></i> ক্লিয়ার
    </button>
    @endif
</form>

@php
$iconMap = [
    'Admin'            => 'fa-shield-halved',
    'Super Agent'      => 'fa-crown',
    'Agent'            => 'fa-user-tie',
    'Customer Service' => 'fa-headset',
];
$has_complaint = $agentsList->contains(fn($a)=>$a->complaint_number);
@endphp

<div class="sec-header">
    <h2>
        <i class="fas {{ $iconMap[$agentType] ?? 'fa-user' }}"></i>
        {{ $labelBn }}
        @if($search)
        <span style="font-size:.72rem;opacity:.75">"{{ $search }}" খোঁজার ফলাফল</span>
        @endif
    </h2>
    <span class="count">{{ $agentsList->count() }} জন</span>
    @if($agentsList->count())
    <button class="btn-shuffle" onclick="shuffleTable(this)" title="র্যান্ডমলি সাজান">
        <i class="fas fa-shuffle"></i> র্যান্ডম
    </button>
    @endif
</div>

<div class="tbl-wrap">
    @if($agentsList->count())
    <table>
        <thead>
            <tr>
                <th class="th-num">ক্রমিক</th>
                <th>এজেন্ট আইডি</th>
                <th>নাম</th>
                <th>হোয়াটসঅ্যাপ</th>
                @if($has_complaint)
                <th>অভিযোগ নম্বর</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($agentsList as $i => $agent)
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
                @if($has_complaint)
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
    @else
    <div style="padding:40px;text-align:center;color:var(--muted);background:#fff">
        <i class="fas fa-search" style="font-size:2rem;margin-bottom:10px;display:block;color:var(--green-bdr)"></i>
        @if($search)
        "<strong>{{ $search }}</strong>" এর জন্য কোনো এজেন্ট পাওয়া যায়নি।
        @else
        কোনো এজেন্ট পাওয়া যায়নি।
        @endif
    </div>
    @endif
</div>

@endsection
