<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arjuna Trans</title>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600&family=Plus+Jakarta+Sans:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface min-h-screen flex antialiased">

    {{-- Panel kiri (branding) --}}
    <div class="flex-1 hidden lg:flex flex-col justify-center px-12 xl:px-24 relative overflow-hidden z-0 bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bus.jpeg') }}');">
        {{-- Overlay gelap supaya teks tetap kebaca di atas gambar --}}
        <div class="absolute inset-0 bg-surface-container-lowest/70 -z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-surface-container-lowest via-surface-container-lowest/40 to-transparent -z-10"></div>

        <div class="max-w-2xl relative z-10">
            <h1 class="font-display-lg text-display-lg text-primary mb-6">ARJUNA TRANS</h1>
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-stack-md">Perjalanan Nyaman, Aman, dan Berkesan</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg">
                Kelola perjalanan dan layanan Arjuna Trans dengan mudah melalui sistem manajemen terintegrasi.
            </p>
        </div>
    </div>

    {{-- Panel kanan (form login) --}}
    <div class="flex-1 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-24 bg-surface z-10 relative shadow-[-20px_0_40px_rgba(0,0,0,0.5)]">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-primary-container/10 rounded-full blur-[100px] -z-10 pointer-events-none lg:hidden"></div>

        <div class="w-full max-w-md glass-card rounded-xl p-8 sm:p-10 relative">
            <div class="lg:hidden mb-10 text-center">
                <h1 class="font-display-lg text-display-lg text-primary mb-2">ARJUNA</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Sistem Manajemen Trans</p>
            </div>

            <div class="mb-stack-md">
                <h3 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-2">Selamat Datang Kembali</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Silakan masuk ke akun Anda untuk melanjutkan.</p>
            </div>

            {{-- Notifikasi error umum (kredensial salah) --}}
            @if ($errors->any() && !$errors->has('email') && !$errors->has('password'))
                <div class="mb-stack-md px-4 py-3 rounded-lg bg-error-container text-on-error-container font-body-md text-body-md">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div class="mb-stack-md px-4 py-3 rounded-lg bg-tertiary-container text-on-tertiary-container font-body-md text-body-md">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="space-y-stack-md">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block font-title-md text-title-md text-on-surface mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-on-surface-variant text-opacity-50">mail</span>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autofocus
                            autocomplete="username"
                            class="input-dark w-full pl-10 pr-4 py-3 rounded-lg font-body-md text-body-md transition-all duration-200"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block font-title-md text-title-md text-on-surface">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-on-surface-variant text-opacity-50">lock</span>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            class="input-dark w-full pl-10 pr-12 py-3 rounded-lg font-body-md text-body-md transition-all duration-200"
                        >
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-on-surface-variant hover:text-primary transition-colors focus:outline-none">
                            <span class="material-symbols-outlined" id="eye-icon">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 rounded bg-surface-container border-on-surface-variant text-primary focus:ring-primary focus:ring-opacity-25 focus:ring-offset-surface">
                    <label for="remember_me" class="ml-2 block font-body-md text-body-md text-on-surface-variant">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm font-title-md text-title-md text-white bg-primary-container hover:bg-[#ff8533] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-container focus:ring-offset-surface transition-all duration-200 active:scale-[0.98]">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>