<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Arjuna Trans')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('resources/js/dashboard-chart.js')

    <!-- 1. Script Tailwind CDN Bawaan Anda -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 2. Import Font Poppins dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- 3. Konfigurasi Tailwind untuk memakai Poppins -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Script Alpine dan icon yang sudah ada -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        [x-cloak] {
            display: none !important;
        }

        .section-kicker {
            letter-spacing: .18em;
        }
    </style>
</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">
        @include('components.sidebar')

        <div class="flex flex-1 flex-col">
            @include('components.header')

            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>


    <script>
        window.arjunaRequest = async function (url, options = {}) {
            const headers = new Headers(options.headers || {});
            headers.set('Accept', 'application/json');
            headers.set('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
            if (options.body && !(options.body instanceof FormData) && !headers.has('Content-Type')) {
                headers.set('Content-Type', 'application/json');
            }

            const response = await fetch(url, { ...options, headers });
            const payload = await response.json().catch(() => ({}));
            if (!response.ok) {
                const firstError = payload.errors ? Object.values(payload.errors).flat()[0] : null;
                throw new Error(firstError || payload.message || 'Terjadi kesalahan saat menyimpan data.');
            }
            return payload;
        };

        window.arjunaUploadImage = async function (file) {
            const form = new FormData();
            form.append('image', file);
            return window.arjunaRequest('{{ route('admin.media.store') }}', { method: 'POST', body: form });
        };
    </script>

    @stack('scripts')
</body>

</html>