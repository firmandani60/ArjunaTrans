<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Arjuna Trans</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
</head>

<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-8 sm:px-6">
        <main class="w-full max-w-md overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10">
            <div class="bg-[#2F2F2F] px-7 py-6 text-center">
                <img src="{{ asset('images/Logo_ArjunaTrans.png') }}" alt="Logo Arjuna Trans" class="mb-2 mx-auto h-16 w-16 rounded-full object-cover">
                <h1 class="text-2xl font-bold tracking-tight text-orange-300">Arjuna Trans</h1>
                <p class="mt-1 text-sm text-gray-300">Admin Console</p>
            </div>

            <div class="p-7 sm:p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Login Admin</h2>
                    <p class="mt-1 text-sm text-slate-500">Masukkan username dan password untuk membuka dashboard.</p>
                </div>

                @if (session('status'))
                <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                    {{ session('status') }}
                </div>
                @endif

                @if (session('error'))
                <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="username" class="mb-2 block text-sm font-semibold text-slate-700">
                            Username
                        </label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" autocomplete="username" autofocus required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20">
                        @error('username')
                        <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">
                            Password
                        </label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20">
                        @error('password')
                        <p class="mt-1.5 text-sm font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center rounded-lg bg-orange-400 px-4 py-3 text-sm font-bold text-white transition duration-200 hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 active:bg-orange-600">
                        Login
                    </button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>