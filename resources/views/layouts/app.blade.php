<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Commute | @yield('title', 'Traffic AI Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: {
                        slate: { 850: '#151e2e', 900: '#0f172a', },
                        primary: '#ffffff',
                        accent: '#8b5cf6'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-panel { background: rgba(15, 15, 15, 0.9); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .gradient-text { color: #ffffff; }
        .metric-card { transition: all 0.2s ease; }
        .metric-card:hover { transform: translateY(-2px); border-color: rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body class="bg-[#000000] text-gray-200 flex h-screen overflow-hidden selection:bg-white selection:text-black">
    
    <aside class="w-64 bg-[#050505] border-r border-zinc-800 flex flex-col justify-between hidden md:flex z-40 relative">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-zinc-800">
                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center mr-3 shadow-[0_0_15px_rgba(255,255,255,0.1)]">
                    <i class="ph ph-traffic-signal text-xl text-black font-bold"></i>
                </div>
                <h1 class="text-xl font-bold tracking-tight text-white">SmartCommute</h1>
            </div>
            <nav class="p-4 space-y-1 mt-4">
                <a href="/" class="flex items-center gap-3 px-4 py-3 {{ request()->is('/') ? 'bg-white text-black font-semibold shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/80 border border-transparent' }} rounded-lg transition-colors">
                    <i class="ph ph-squares-four text-xl"></i> Dashboard
                </a>
                <a href="/cameras" class="flex items-center gap-3 px-4 py-3 {{ request()->is('cameras') ? 'bg-white text-black font-semibold shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/80 border border-transparent' }} rounded-lg transition-colors">
                    <i class="ph ph-video-camera text-xl"></i> Camera Feeds
                </a>
                <a href="/violations" class="flex items-center gap-3 px-4 py-3 {{ request()->is('violations') ? 'bg-white text-black font-semibold shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/80 border border-transparent' }} rounded-lg transition-colors">
                    <i class="ph ph-shield-warning text-xl"></i> Violations Log
                </a>
                <a href="/rides" class="flex items-center gap-3 px-4 py-3 {{ request()->is('rides') ? 'bg-white text-black font-semibold shadow-md' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/80 border border-transparent' }} rounded-lg transition-colors">
                    <i class="ph ph-car-profile text-xl"></i> Ride Operations
                </a>
            </nav>
        </div>
        <div class="p-4">
            <div class="bg-zinc-900 border border-zinc-800 p-4 rounded-xl items-center gap-3 flex">
                <div class="w-10 h-10 rounded bg-white flex items-center justify-center text-black font-bold text-xs shadow-[0_0_10px_rgba(255,255,255,0.1)]">
                    SYS
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white leading-tight">Systems Admin</h4>
                    <div class="text-[10px] font-bold text-green-400 uppercase tracking-widest mt-0.5">Network Online</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto bg-[#000000] relative">
        <div class="p-8 md:p-10 max-w-7xl mx-auto min-h-full">
            @yield('content')
            
            <footer class="mt-12 text-center text-sm text-zinc-600 pb-8 flex items-center justify-center gap-2">
                <i class="ph-fill ph-code text-lg"></i> Architected dynamically for Advanced Traffic & Accident Prevention
            </footer>
        </div>
    </main>
    
    @yield('scripts')
</body>
</html>
