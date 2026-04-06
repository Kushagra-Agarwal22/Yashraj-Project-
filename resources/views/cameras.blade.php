@extends('layouts.app')

@section('title', 'City Camera Feeds')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Citywide Camera Feeds</h2>
    <p class="text-slate-400">Live surveillance monitoring and traffic junction feeds.</p>
</div>

<!-- Filters -->
<div class="glass-panel p-4 rounded-xl mb-8 flex flex-wrap gap-4 items-center justify-between bg-slate-800/20 border border-slate-700/50">
    <div class="flex gap-4">
        <select id="citySelector" onchange="updateCities(this.value)" class="bg-zinc-900 text-gray-200 border border-zinc-700 rounded-lg px-4 py-2 outline-none focus:border-white transition">
            <option value="All Cities">All Cities</option>
            <option value="Bangalore (HQ)">Bangalore (HQ)</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Pune">Pune</option>
        </select>
        <select class="bg-zinc-900 text-gray-200 border border-zinc-700 rounded-lg px-4 py-2 outline-none focus:border-white transition">
            <option>All Camera Types</option>
            <option>PTZ Intersection</option>
            <option>ANPR (Number Plate)</option>
            <option>Speed Radar</option>
        </select>
    </div>
    <div class="bg-zinc-900 px-4 py-2 rounded-lg text-sm text-green-400 font-medium flex items-center gap-2 border border-zinc-800">
        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.8)]"></div>
        124 Active Feeds City-Wide
    </div>
</div>

<!-- Camera Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
    <!-- Camera 1 -->
    <div class="bg-[#0a0a0a] rounded-2xl overflow-hidden border border-zinc-800 hover:border-zinc-500 transition-all shadow-sm relative group">
        <div class="relative h-64 bg-black overflow-hidden flex items-center justify-center">
            <iframe class="absolute w-[150%] h-[150%] pointer-events-none opacity-80" style="transform: scale(1.1);" src="https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&controls=0&disablekb=1&loop=1&playlist=1EiC9bvVGnk&showinfo=0&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
            <div class="absolute inset-0 bg-black/40 pointer-events-none z-10"></div>
            <div class="absolute top-3 left-3 bg-white text-black text-[10px] font-bold px-2 py-1 rounded animate-pulse shadow-sm z-20">LIVE REC</div>
            <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur text-gray-300 text-xs px-2 py-1 rounded font-mono border border-zinc-800 z-20">{{ now()->format('Y-m-d H:i:s') }} IST</div>
        </div>
        <div class="p-4 border-t border-zinc-800 flex flex-col justify-between relative z-20" style="min-height: 140px;">
            <div>
                <h3 id="title-1" class="text-white font-bold mb-1 line-clamp-1"><i class="ph ph-map-pin text-zinc-500"></i> CCTV-BLR-01: Sony World Junction, Bangalore</h3>
                <p class="text-xs mb-4 text-emerald-500 font-medium cursor-default">Status: Optimal visibility (Processing ANPR)</p>
            </div>
            <div class="flex gap-2 mt-auto">
                <button onclick="openModal('1EiC9bvVGnk')" class="bg-white text-black font-bold hover:bg-gray-200 px-3 py-2 rounded-lg text-sm transition w-full flex justify-center items-center gap-2"><i class="ph ph-arrows-out"></i> View Full Stream</button>
            </div>
        </div>
    </div>

    <!-- Camera 2 -->
    <div class="bg-[#0a0a0a] rounded-2xl overflow-hidden border border-zinc-800 hover:border-zinc-500 transition-all shadow-sm relative group">
        <div class="relative h-64 bg-black overflow-hidden flex items-center justify-center">
            <!-- Horizontally flipped and zoomed -->
            <iframe class="absolute w-[150%] h-[150%] pointer-events-none opacity-80" style="transform: scaleX(-1) scale(1.3) translateY(10%);" src="https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&controls=0&disablekb=1&loop=1&playlist=1EiC9bvVGnk&showinfo=0&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
            <div class="absolute inset-0 bg-black/40 pointer-events-none z-10"></div>
            <div class="absolute top-3 left-3 bg-white text-black text-[10px] font-bold px-2 py-1 rounded animate-pulse shadow-sm z-20">LIVE REC</div>
            <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur text-gray-300 text-xs px-2 py-1 rounded font-mono border border-zinc-800 z-20">{{ now()->format('Y-m-d H:i:s') }} IST</div>
        </div>
        <div class="p-4 border-t border-zinc-800 flex flex-col justify-between relative z-20" style="min-height: 140px;">
            <div>
                <h3 id="title-2" class="text-white font-bold mb-1 line-clamp-1"><i class="ph ph-map-pin text-zinc-500"></i> CCTV-MUM-04: Bandra Kurla Complex, Mumbai</h3>
                <p class="text-xs mb-4 text-emerald-500 font-medium cursor-default">Status: Recording (Processing Wait Times)</p>
            </div>
            <div class="flex gap-2 mt-auto">
                <button onclick="openModal('1EiC9bvVGnk')" class="bg-white text-black font-bold hover:bg-gray-200 px-3 py-2 rounded-lg text-sm transition w-full flex justify-center items-center gap-2"><i class="ph ph-arrows-out"></i> View Full Stream</button>
            </div>
        </div>
    </div>

    <!-- Camera 3 -->
    <div class="bg-[#0a0a0a] rounded-2xl overflow-hidden border border-zinc-800 hover:border-zinc-500 transition-all shadow-sm relative group">
        <div class="relative h-64 bg-black overflow-hidden flex items-center justify-center">
            <!-- Zoomed and shifted to another part of the intersection -->
            <iframe class="absolute w-[200%] h-[200%] pointer-events-none opacity-80" style="transform: scale(1.4) translate(-10%, -5%);" src="https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&controls=0&disablekb=1&loop=1&playlist=1EiC9bvVGnk&showinfo=0&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
            <div class="absolute inset-0 bg-black/40 pointer-events-none z-10"></div>
            <div class="absolute top-3 left-3 bg-white text-black text-[10px] font-bold px-2 py-1 rounded animate-pulse shadow-sm z-20">LIVE REC</div>
            <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur text-gray-300 text-xs px-2 py-1 rounded font-mono border border-zinc-800 z-20">{{ now()->format('Y-m-d H:i:s') }} IST</div>
        </div>
        <div class="p-4 border-t border-zinc-800 flex flex-col justify-between relative z-20" style="min-height: 140px;">
            <div>
                <h3 id="title-3" class="text-white font-bold mb-1 line-clamp-1"><i class="ph ph-map-pin text-zinc-500"></i> CCTV-DEL-12: Connaught Place, Delhi</h3>
                <p class="text-xs mb-4 text-emerald-500 font-medium cursor-default">Status: Optimal visibility (Processing ANPR)</p>
            </div>
            <div class="flex gap-2 mt-auto">
                <button onclick="openModal('1EiC9bvVGnk')" class="bg-white text-black font-bold hover:bg-gray-200 px-3 py-2 rounded-lg text-sm transition w-full flex justify-center items-center gap-2"><i class="ph ph-arrows-out"></i> View Full Stream</button>
            </div>
        </div>
    </div>

    <!-- Camera 4 -->
    <div class="bg-[#0a0a0a] rounded-2xl overflow-hidden border border-zinc-800 hover:border-zinc-500 transition-all shadow-sm relative group">
        <div class="relative h-64 bg-black overflow-hidden flex items-center justify-center">
             <!-- Horizontally flipped and shifted -->
            <iframe class="absolute w-[180%] h-[180%] pointer-events-none opacity-80" style="transform: scaleX(-1) scale(1.6) translate(15%, 5%);" src="https://www.youtube.com/embed/1EiC9bvVGnk?autoplay=1&mute=1&controls=0&disablekb=1&loop=1&playlist=1EiC9bvVGnk&showinfo=0&rel=0" frameborder="0" allow="autoplay; encrypted-media"></iframe>
            <div class="absolute inset-0 bg-black/40 pointer-events-none z-10"></div>
            <div class="absolute top-3 left-3 bg-white text-black text-[10px] font-bold px-2 py-1 rounded animate-pulse shadow-sm z-20">LIVE REC</div>
            <div class="absolute bottom-3 right-3 bg-black/80 backdrop-blur text-gray-300 text-xs px-2 py-1 rounded font-mono border border-zinc-800 z-20">{{ now()->format('Y-m-d H:i:s') }} IST</div>
        </div>
        <div class="p-4 border-t border-zinc-800 flex flex-col justify-between relative z-20" style="min-height: 140px;">
            <div>
                <h3 id="title-4" class="text-white font-bold mb-1 line-clamp-1"><i class="ph ph-map-pin text-zinc-500"></i> CCTV-PUN-02: Hinjewadi Phase 1, Pune</h3>
                <p class="text-xs mb-4 text-emerald-500 font-medium cursor-default">Status: Heavy Traffic Detected</p>
            </div>
            <div class="flex gap-2 mt-auto">
                <button onclick="openModal('1EiC9bvVGnk')" class="bg-white text-black font-bold hover:bg-gray-200 px-3 py-2 rounded-lg text-sm transition w-full flex justify-center items-center gap-2"><i class="ph ph-arrows-out"></i> View Full Stream</button>
            </div>
        </div>
    </div>
</div>

<!-- Full Stream Modal -->
<div id="streamModal" class="fixed inset-0 z-50 bg-black/95 hidden flex flex-col items-center justify-center backdrop-blur-sm transition-opacity duration-300">
    <div class="w-full max-w-5xl px-4 py-3 flex justify-between items-center border-b border-white/10 bg-gradient-to-b from-black/80 to-transparent">
        <h2 class="text-white font-bold text-lg flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div> CCTV Enterprise Viewer // ACTIVE</h2>
        <button onclick="closeModal()" class="text-slate-300 hover:text-white hover:bg-zinc-800 px-4 py-1.5 border border-zinc-700 rounded-lg transition"><i class="ph ph-x"></i> Close Feed</button>
    </div>
    <div class="w-full max-w-5xl flex-grow max-h-[75vh] object-cover bg-black relative border border-zinc-800 shadow-2xl rounded-b-xl overflow-hidden mt-0">
        <!-- Interactive viewer iframe, pointer events re-enabled -->
        <iframe id="modalIframe" class="w-full h-full" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        <!-- HUD Overlay Elements -->
        <div class="absolute top-4 right-4 bg-black/60 backdrop-blur px-2 py-1 rounded text-white font-mono text-xs border border-white/10 pointer-events-none">REC: FULL SCREEN ALIGN</div>
        <div class="absolute bottom-16 left-4 bg-black/60 backdrop-blur px-2 py-1 rounded text-green-400 font-mono text-xs border border-green-500/30 pointer-events-none">AI Trak: ONLINE</div>
    </div>
</div>

<script>
const cityData = {
    'All Cities': [
        'CCTV-BLR-01: Sony World Junction, Bangalore',
        'CCTV-MUM-04: Bandra Kurla Complex, Mumbai',
        'CCTV-DEL-12: Connaught Place, Delhi',
        'CCTV-PUN-02: Hinjewadi Phase 1, Pune'
    ],
    'Bangalore (HQ)': [
        'CCTV-BLR-01: Sony World Junction',
        'CCTV-BLR-02: MG Road',
        'CCTV-BLR-03: Indiranagar 100ft Rd',
        'CCTV-BLR-04: Electronic City Phase 1'
    ],
    'Mumbai': [
        'CCTV-MUM-01: Marine Drive',
        'CCTV-MUM-02: Bandra Kurla Complex',
        'CCTV-MUM-03: Worli Sea Face',
        'CCTV-MUM-04: Andheri East'
    ],
    'Delhi': [
        'CCTV-DEL-01: Connaught Place',
        'CCTV-DEL-02: India Gate Circle',
        'CCTV-DEL-03: Hauz Khas',
        'CCTV-DEL-04: Vasant Kunj'
    ],
    'Pune': [
        'CCTV-PUN-01: Hinjewadi Phase 1',
        'CCTV-PUN-02: Koregaon Park',
        'CCTV-PUN-03: Viman Nagar',
        'CCTV-PUN-04: Magarpatta City'
    ]
};

function updateCities(city) {
    const areas = cityData[city] || cityData['All Cities'];
    document.getElementById('title-1').innerHTML = '<i class="ph ph-map-pin text-zinc-500"></i> ' + areas[0];
    document.getElementById('title-2').innerHTML = '<i class="ph ph-map-pin text-zinc-500"></i> ' + areas[1];
    document.getElementById('title-3').innerHTML = '<i class="ph ph-map-pin text-zinc-500"></i> ' + areas[2];
    document.getElementById('title-4').innerHTML = '<i class="ph ph-map-pin text-zinc-500"></i> ' + areas[3];
}

function openModal(videoId) {
    document.getElementById('streamModal').classList.remove('hidden');
    // Construct fullscreen embed URL. Note: we allow controls here so the user can interact.
    document.getElementById('modalIframe').src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&mute=1&controls=1&showinfo=0&rel=0';
}
function closeModal() {
    document.getElementById('streamModal').classList.add('hidden');
    // Wipe src to stop audio/playback instantly
    document.getElementById('modalIframe').src = '';
}
</script>
@endsection
