<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-950 bg-gradient-to-br from-slate-900 via-slate-950 to-indigo-950/40 px-4 font-sans text-slate-100 antialiased">

    <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/2 top-0 h-96 w-[36rem] -translate-x-1/2 rounded-full bg-indigo-600/10 blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="mb-8 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Farhan Maulana Syidiq" width="53" height="48" style="height:48px;width:auto;" class="mx-auto mb-4 mix-blend-screen">
            <h1 class="text-2xl font-bold tracking-tight">Panel Admin</h1>
            <p class="mt-2 text-sm text-slate-400">Masuk untuk mengelola portofolio &amp; pesan masuk.</p>
        </div>

        <div class="rounded-2xl border border-slate-800 bg-slate-900/70 p-8 shadow-2xl backdrop-blur">
            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-rose-500/30 bg-rose-500/10 p-4" role="alert">
                    <ul class="space-y-1 text-sm text-rose-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                    @error('email') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-300">Kata Sandi</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           class="w-full rounded-xl border border-slate-700 bg-slate-950/60 px-4 py-3 text-sm text-white placeholder-slate-600 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30">
                    @error('password') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2.5 text-sm text-slate-400">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-indigo-500 focus:ring-indigo-500/40">
                    Ingat saya
                </label>

                <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Masuk
                </button>
            </form>
        </div>

        <p class="mt-8 text-center text-sm text-slate-500">
            <a href="{{ route('portfolio.index') }}" class="transition hover:text-slate-300">&larr; Kembali ke halaman publik</a>
        </p>
    </div>

    <style>[x-cloak]{display:none!important}</style>
</body>
</html>
