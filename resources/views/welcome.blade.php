@extends('layouts.app')

@section('content')
<header class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
    <div>
        <h2 class="text-3xl font-bold tracking-tight text-white mb-1">City Analytics Control</h2>
        <p class="text-slate-400">AI-Powered Webster's Timings & Violation Detection</p>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2 px-4 py-2 glass-panel rounded-full text-sm font-medium">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            AI Engine: <span class="text-green-400">Online</span>
        </div>
    </div>
</header>

@if(session('success'))
<div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-xl flex items-center shadow-lg">
    <i class="ph-fill ph-check-circle text-2xl mr-3"></i>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="glass-panel p-6 rounded-2xl metric-card relative overflow-hidden">
        <div class="absolute -right-2 top-0 text-7xl text-primary/5"><i class="ph-fill ph-car"></i></div>
        <p class="text-slate-400 text-sm font-medium mb-1">Total Vehicles Analyzed</p>
        <h3 class="text-3xl font-bold text-white mb-2">{{ $logs ?? 2314 }} <span class="text-sm font-medium text-green-400 ml-2">↑ 12%</span></h3>
        <div class="w-full bg-slate-800 rounded-full h-1"><div class="bg-primary h-1 rounded-full w-3/4"></div></div>
    </div>
    
    <div class="glass-panel p-6 rounded-2xl metric-card relative overflow-hidden border-t-2 border-t-red-500/50">
        <div class="absolute -right-2 top-0 text-7xl text-red-500/5"><i class="ph-fill ph-warning"></i></div>
        <p class="text-slate-400 text-sm font-medium mb-1">Recorded Violations</p>
        <h3 class="text-3xl font-bold text-white mb-2">{{ $violations_count ?? 42 }} <span class="text-sm font-medium text-red-400 ml-2">Critical</span></h3>
        <div class="w-full bg-slate-800 rounded-full h-1"><div class="bg-red-500 h-1 rounded-full w-1/4"></div></div>
    </div>

    <div class="glass-panel p-6 rounded-2xl metric-card relative overflow-hidden">
        <div class="absolute -right-2 top-0 text-7xl text-accent/5"><i class="ph-fill ph-timer"></i></div>
        <p class="text-slate-400 text-sm font-medium mb-1">Avg. Wait Time</p>
        <h3 class="text-3xl font-bold text-white mb-2">28s <span class="text-sm font-medium text-green-400 ml-2">↓ Optimized</span></h3>
        <div class="w-full bg-slate-800 rounded-full h-1"><div class="bg-accent h-1 rounded-full w-1/2"></div></div>
    </div>

    <div class="glass-panel p-6 rounded-2xl metric-card relative overflow-hidden">
        <div class="absolute -right-2 top-0 text-7xl text-emerald-500/5"><i class="ph-fill ph-cpu"></i></div>
        <p class="text-slate-400 text-sm font-medium mb-1">Current AI Confidence</p>
        <h3 class="text-3xl font-bold text-white mb-2">94.5% <span class="text-sm font-medium text-emerald-400 ml-2">Stable</span></h3>
        <div class="w-full bg-slate-800 rounded-full h-1"><div class="bg-emerald-500 h-1 rounded-full w-[94%]"></div></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <div class="glass-panel rounded-3xl p-8 relative overflow-hidden border border-slate-700 hover:border-slate-600 transition-colors">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
            
            <div class="flex items-center justify-between mb-6 relative">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="ph-fill ph-upload-simple text-primary"></i> 
                    Ingest New Camera Feed
                </h3>
                <span class="text-xs bg-slate-800 text-slate-300 py-1 px-3 rounded-full border border-slate-700">OpenCV Native</span>
            </div>

            <form action="{{ route('uploadVideo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="video" class="block w-full border-2 border-dashed border-slate-600 hover:border-primary/50 hover:bg-primary/5 transition-all rounded-2xl p-10 text-center cursor-pointer group">
                    <div class="w-16 h-16 bg-slate-800 group-hover:bg-primary/20 text-slate-400 group-hover:text-primary rounded-full flex items-center justify-center mx-auto mb-4 transition-colors">
                        <i class="ph ph-video-camera text-3xl"></i>
                    </div>
                    <p class="text-lg font-medium text-white mb-1 group-hover:text-primary transition-colors">Select Video or Image</p>
                    <p class="text-sm text-slate-400 font-medium" id="file-name-display">MP4, JPG, PNG up to 100MB</p>
                    <input type="file" name="video" id="video" accept="video/*,image/*" required class="hidden" onChange="document.getElementById('file-name-display').textContent = this.files[0] ? this.files[0].name : 'MP4, JPG, PNG up to 100MB'">
                </label>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-primary to-accent hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.5)] transition-all flex items-center gap-2">
                        Run Deep Neural Net <i class="ph-bold ph-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="glass-panel rounded-3xl p-8 border border-slate-700">
            <h3 class="text-xl font-bold text-white mb-6">Real-Time Traffic Density</h3>
            <div class="h-64"><canvas id="trafficChart"></canvas></div>
        </div>
    </div>

    <div class="glass-panel rounded-3xl p-6 border border-slate-700 flex flex-col h-full opacity-95">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="ph-fill ph-siren text-red-500 animate-pulse"></i> 
                Recent Violations
            </h3>
            <a href="/violations" class="text-xs text-primary hover:text-blue-400 font-medium">View All <i class="ph ph-arrow-right"></i></a>
        </div>

        <div class="space-y-4 overflow-y-auto pr-2 flex-1">
            @if(isset($violations) && count($violations) > 0)
                @foreach($violations->take(5) as $violation)
                <div class="bg-slate-800/80 p-4 rounded-xl border border-slate-700 shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <div class="bg-slate-900 border border-slate-600 px-3 py-1 rounded-md mb-2 inline-block"><span class="font-mono font-bold text-[#fbbf24]">{{ $violation->plate_number ?? 'UNKNOWN' }}</span></div>
                            <div class="text-xs text-slate-400 flex items-center gap-1"><i class="ph ph-clock"></i> {{ \Carbon\Carbon::parse($violation->timestamp)->diffForHumans() }}</div>
                        </div>
                        <div class="flex flex-col items-end">
                            <span class="text-xs font-semibold px-2 py-1 bg-red-500/10 text-red-400 border border-red-500/20 rounded-md">Detected</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-sm text-slate-400 text-center py-10">No recent violations recorded.</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('trafficChart').getContext('2d');
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)');   
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['8AM', '10AM', '12PM', '2PM', '4PM', '6PM', '8PM'],
            datasets: [{
                label: 'Lane Flow (Vehicles/hr)', data: [120, 190, 140, 150, 220, 280, 170],
                borderColor: '#3b82f6', backgroundColor: gradient, borderWidth: 3,
                tension: 0.4, fill: true
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } },
                x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
            }
        }
    });
</script>
@endsection
