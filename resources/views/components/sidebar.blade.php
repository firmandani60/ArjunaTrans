<aside class="sticky top-0 flex h-screen w-72 flex-col bg-[#2F2F2F] text-white shadow-xl">

    <!-- Logo -->
    <div class="border-b border-gray-600 p-6">
        <h1 class="text-2xl font-bold text-orange-300">Arjuna Trans</h1>
        <p class="text-sm text-gray-400">Admin Console</p>
    </div>

    <!-- Menu -->
    <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-lg bg-orange-400 px-4 py-3 font-medium text-white transition duration-300 hover:bg-orange-500">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="image" class="h-5 w-5"></i>
            <span>Hero</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="star" class="h-5 w-5"></i>
            <span>Keunggulan</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="briefcase" class="h-5 w-5"></i>
            <span>Layanan</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="building-2" class="h-5 w-5"></i>
            <span>Tentang Kami</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="bus" class="h-5 w-5"></i>
            <span>Armada</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="map-pinned" class="h-5 w-5"></i>
            <span>Destinasi</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="route" class="h-5 w-5"></i>
            <span>Rute & Harga</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="ticket" class="h-5 w-5"></i>
            <span>Pemesanan</span>
        </a>

        <a href="#" class="flex items-center gap-3 rounded-lg px-4 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="phone" class="h-5 w-5"></i>
            <span>Kontak</span>
        </a>

    </nav>

    <!-- Logout -->
    <div class="border-t border-gray-600 p-6">
        <button class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-600 py-3 transition duration-300 hover:bg-orange-400">
            <i data-lucide="log-out" class="h-5 w-5"></i>
            <span>Keluar</span>
        </button>
    </div>

</aside>