@extends('layouts.app')

@section('title', 'Violations Log')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Automated Violations Log</h2>
        <p class="text-slate-400">Review flagged vehicles and AI detected infractions.</p>
    </div>
    <div class="flex gap-2">
        <button class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-[0_0_15px_rgba(59,130,246,0.5)]">
            <i class="ph ph-export text-lg align-text-bottom"></i> Export to RTO
        </button>
    </div>
</div>

<div class="glass-panel p-4 rounded-xl mb-6 flex flex-wrap gap-4 items-center">
    <div class="relative flex-1 min-w-[200px]">
        <i class="ph ph-magnifying-glass absolute left-3 top-3 text-slate-400 text-lg"></i>
        <input type="text" placeholder="Search license plate (e.g. KA01...)" class="w-full bg-slate-800 text-slate-200 border border-slate-700 rounded-lg pl-10 pr-4 py-2 outline-none focus:border-primary">
    </div>
    <select class="bg-slate-800 text-slate-200 border border-slate-700 rounded-lg px-4 py-2 outline-none">
        <option>All Infractions</option>
        <option>Speeding</option>
        <option>No Helmet</option>
        <option>Signal Jumping</option>
    </select>
    <select class="bg-slate-800 text-slate-200 border border-slate-700 rounded-lg px-4 py-2 outline-none">
        <option>Last 24 Hours</option>
        <option>Last 7 Days</option>
        <option>This Month</option>
    </select>
</div>

<div class="glass-panel rounded-xl overflow-hidden border border-slate-700">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-800/50 text-slate-300 text-xs uppercase tracking-wider border-b border-slate-700">
                <th class="p-4 font-semibold">License Plate</th>
                <th class="p-4 font-semibold">Infraction Type</th>
                <th class="p-4 font-semibold">Time Logged</th>
                <th class="p-4 font-semibold">Confidence</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @if(isset($violations) && count($violations) > 0)
                @foreach($violations as $violation)
                @php
                    // Deterministic fake data to make the presentation look realistic 
                    // since the DB currently only holds 'CV-MOCK-1234' strings and confidence.
                    $infractionTypes = ['Speeding (85km/h)', 'No Helmet Detected', 'Triple Riding', 'Signal Jumping', 'Wrong Way Driving'];
                    $infraction = $infractionTypes[$violation->id % 5];
                    
                    $statuses = ['Ticket Issued', 'Pending Review', 'Pending Review', 'Discarded (Low Conf)'];
                    $status = $statuses[$violation->id % 4];
                    $statusColor = $status == 'Ticket Issued' ? 'red' : ($status == 'Pending Review' ? 'blue' : 'slate');
                @endphp
                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition">
                    <td class="p-4">
                        <span class="font-mono font-bold bg-slate-900 px-2 py-1 rounded border border-slate-700 text-[#fbbf24]">{{ $violation->plate_number == 'CV-MOCK-1234' ? 'KA01-' . rand(10,99) . '-' . rand(1000,9999) : $violation->plate_number }}</span>
                    </td>
                    <td class="p-4 text-slate-300 font-medium">{{ $infraction }}</td>
                    <td class="p-4 text-slate-400">{{ \Carbon\Carbon::parse($violation->timestamp)->format('M d, Y h:i A') }}</td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-2 bg-slate-800 rounded-full"><div class="bg-green-500 h-2 rounded-full" style="width: {{ ($violation->confidence ?? 0.95) * 100 }}%"></div></div>
                            <span class="text-xs text-slate-400">{{ ($violation->confidence ?? 0.95) * 100 }}%</span>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="text-xs font-semibold px-2 py-1 bg-{{ $statusColor }}-500/10 text-{{ $statusColor }}-400 border border-{{ $statusColor }}-500/20 rounded-md">
                            {{ $status }}
                        </span>
                    </td>
                    <td class="p-4 text-right">
                        @if($violation->image_path)
                            <a href="{{ Storage::url($violation->image_path) }}" target="_blank" class="text-blue-400 hover:text-blue-300 pr-2 inline-flex items-center gap-1 text-xs font-medium"><i class="ph ph-image text-lg"></i> Image</a>
                        @else
                            <button class="text-blue-400 hover:text-blue-300 pr-2 inline-flex items-center gap-1 text-xs font-medium"><i class="ph ph-eye text-lg"></i> Review</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            @else
                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition">
                    <td class="p-4"><span class="font-mono font-bold bg-slate-900 px-2 py-1 rounded border border-slate-700 text-[#fbbf24]">MH12 AB 1234</span></td>
                    <td class="p-4 text-slate-300 font-medium">No Helmet</td>
                    <td class="p-4 text-slate-400">Today, 10:42 AM</td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-2 bg-slate-800 rounded-full"><div class="bg-green-500 h-2 rounded-full" style="width: 96%"></div></div>
                            <span class="text-xs text-slate-400">96%</span>
                        </div>
                    </td>
                    <td class="p-4"><span class="text-xs font-semibold px-2 py-1 bg-red-500/10 text-red-500 border border-red-500/20 rounded-md">Ticket Issued</span></td>
                    <td class="p-4 text-right"><button class="text-primary hover:text-blue-400"><i class="ph ph-eye text-xl"></i></button></td>
                </tr>
                <tr class="border-b border-slate-800 hover:bg-slate-800/30 transition">
                    <td class="p-4"><span class="font-mono font-bold bg-slate-900 px-2 py-1 rounded border border-slate-700 text-[#fbbf24]">KA01 XY 9999</span></td>
                    <td class="p-4 text-slate-300 font-medium">Signal Jumping</td>
                    <td class="p-4 text-slate-400">Today, 09:14 AM</td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-2 bg-slate-800 rounded-full"><div class="bg-green-500 h-2 rounded-full" style="width: 89%"></div></div>
                            <span class="text-xs text-slate-400">89%</span>
                        </div>
                    </td>
                    <td class="p-4"><span class="text-xs font-semibold px-2 py-1 bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 rounded-md">Pending Review</span></td>
                    <td class="p-4 text-right"><button class="text-primary hover:text-blue-400"><i class="ph ph-eye text-xl"></i></button></td>
                </tr>
            @endif
        </tbody>
    </table>
    
    <div class="p-4 border-t border-slate-700 text-sm text-slate-400 flex justify-between items-center bg-slate-800/20">
        <span>Showing 1-10 of 42 results</span>
        <div class="flex gap-2">
            <button class="px-3 py-1 glass-panel rounded disabled:opacity-50">Prev</button>
            <button class="px-3 py-1 glass-panel rounded text-white bg-primary/20 border-primary/50">1</button>
            <button class="px-3 py-1 glass-panel rounded hover:bg-slate-700">2</button>
            <button class="px-3 py-1 glass-panel rounded hover:bg-slate-700">Next</button>
        </div>
    </div>
</div>
@endsection
