<aside class="sticky top-0 flex h-screen w-72 flex-col bg-[#2F2F2F] text-white shadow-xl">
    <div class="border-b border-gray-600 p-6">
        <h1 class="text-2xl font-bold text-orange-300">Arjuna Trans</h1>
        <p class="text-sm text-gray-400">Admin Console</p>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
        <a href="{{ route('dashboard') }}" 
           class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('dashboard') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.hero') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.hero') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="image" class="h-5 w-5"></i>
            <span>Hero</span>
        </a>
        <a href="{{ route('admin.keunggulan') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.keunggulan') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="star" class="h-5 w-5"></i>
            <span>Keunggulan</span>
        </a>
        <a href="{{ route('admin.layanan') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.layanan') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="briefcase" class="h-5 w-5"></i>
            <span>Layanan</span>
        </a>
        <a href="{{ route('admin.tentang-kami') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.tentang-kami') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="building-2" class="h-5 w-5"></i>
            <span>Tentang Kami</span>
        </a>
        <a href="{{ route('admin.armada') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.armada') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="bus" class="h-5 w-5"></i>
            <span>Armada</span>
        </a>
        <a href="{{ route('admin.destinasi') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.destinasi') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="map-pinned" class="h-5 w-5"></i>
            <span>Destinasi</span>
        </a>
        <a href="{{ route('admin.rute-harga') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.rute-harga') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="route" class="h-5 w-5"></i>
            <span>Rute & Harga</span>
        </a>
        <a href="{{ route('admin.cara-pesan') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.cara-pesan') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="ticket" class="h-5 w-5"></i>
            <span>Cara Pesan</span>
        </a>
        <a href="{{ route('admin.kontak') }}" 
            class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400 {{ request()->routeIs('admin.kontak') ? 'bg-orange-400 text-white font-medium' : 'text-gray-300' }}">
            <i data-lucide="phone" class="h-5 w-5"></i>
            <span>Kontak</span>
        </a>
    </nav>

    <div class="border-t border-gray-600 p-6">
        <button class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-600 py-3 text-gray-300 transition duration-300 hover:bg-orange-400 hover:text-white">
            <i data-lucide="log-out" class="h-5 w-5"></i>
            <span>Keluar</span>
        </button>
    </div>
</aside>