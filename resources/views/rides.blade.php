@extends('layouts.app')

@section('title', 'Ride Operations')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Ride Operations Integration</h2>
    <p class="text-slate-400">Manage smart commute system connections and API ride requests.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
    <div class="lg:col-span-1 space-y-6">
        <!-- Status Card -->
        <div class="bg-slate-800/40 border border-slate-700/50 p-6 rounded-2xl relative overflow-hidden shadow-sm">
            <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center mb-4 text-blue-500 text-2xl border border-blue-500/20">
                <i class="ph-fill ph-taxi"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-1">Fleet Connect API</h3>
            <p class="text-sm text-slate-400 mb-4">Endpoints synced and actively receiving pings from physical on-ground fleet units.</p>
            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-green-400 bg-green-500/10 px-3 py-1.5 rounded-lg inline-flex border border-green-500/20">
                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                Healthy
            </div>
        </div>

        <div class="bg-slate-800/40 border border-slate-700/50 p-6 rounded-2xl relative overflow-hidden shadow-sm">
            <h3 class="text-slate-300 font-bold mb-4 flex items-center gap-2"><i class="ph ph-plugs"></i> API Endpoints</h3>
            <div class="space-y-3">
                <div class="bg-slate-800 p-3 rounded-lg border border-slate-700">
                    <span class="text-xs font-bold text-green-400 border border-green-400/30 bg-green-500/10 px-1 py-0.5 rounded mr-2">GET</span>
                    <span class="text-sm font-mono text-slate-300">/api/rides</span>
                </div>
                <div class="bg-slate-800 p-3 rounded-lg border border-slate-700">
                    <span class="text-xs font-bold text-blue-400 border border-blue-400/30 bg-blue-500/10 px-1 py-0.5 rounded mr-2">POST</span>
                    <span class="text-sm font-mono text-slate-300">/api/login</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Rides Table -->
    <div class="lg:col-span-3 glass-panel rounded-2xl border border-slate-700 p-6 flex flex-col">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="ph-fill ph-map-pin-line text-accent"></i> 
                Active Fleet Map Data (Local DB)
            </h3>
            <button class="text-sm text-slate-300 bg-slate-800 hover:bg-slate-700 px-3 py-1.5 rounded transition border border-slate-600">
                <i class="ph ph-arrows-clockwise"></i> Refresh
            </button>
        </div>

        <div class="overflow-x-auto flex-1">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="text-slate-400 text-xs uppercase tracking-wider border-b border-slate-700">
                        <th class="pb-3 font-semibold">Ride ID</th>
                        <th class="pb-3 font-semibold">Driver</th>
                        <th class="pb-3 font-semibold">Pickup -> Destination</th>
                        <th class="pb-3 font-semibold">Scheduled Time</th>
                        <th class="pb-3 font-semibold text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse(\App\Models\Ride::all() as $ride)
                    <tr class="border-b border-slate-800/50 hover:bg-slate-800/30 transition">
                        <td class="py-4 font-mono text-slate-300">#RD-{{ str_pad($ride->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-4 text-white font-medium flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($ride->driverName) }}&background=random" class="w-6 h-6 rounded-full" alt="driver">
                            {{ $ride->driverName }}
                        </td>
                        <td class="py-4 text-slate-300">
                            <span class="text-slate-400">{{ $ride->pickupLocation }}</span> 
                            <i class="ph-bold ph-arrow-right text-primary mx-1"></i> 
                            {{ $ride->destination }}
                        </td>
                        <td class="py-4 text-slate-400">{{ \Carbon\Carbon::parse($ride->time)->format('h:i A - M d') }}</td>
                        <td class="py-4 text-right">
                            @if($ride->status == 'Completed')
                                <span class="bg-green-500/10 text-green-400 px-2 py-1 rounded text-xs border border-green-500/20 font-medium">Completed</span>
                            @else
                                <span class="bg-blue-500/10 text-blue-400 px-2 py-1 rounded text-xs border border-blue-500/20 font-medium">Upcoming</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-slate-500 italic">No rides mapped to Smart Commute API yet. Check SQLite.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
