{{--
    Layout bersama halaman publik (landing page + blog).
    Props: $title, $description, $image (URL absolut opsional), $type (website/article).
    Konten halaman diisi lewat $slot.
--}}
@props([
    'title' => 'Farhan Maulana Syidiq — NOC Engineer & Web Developer',
    'description' => 'Portofolio Farhan Maulana Syidiq — NOC Engineer, Network Administrator & Web Developer. Spesialis MikroTik RouterOS, OLT GPON/EPON, Proxmox VE, dan Laravel.',
    'image' => null,
    'type' => 'website',
])
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:type" content="{{ $type }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($image)
        <meta property="og:image" content="{{ $image }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    @if ($image)
        <meta name="twitter:image" content="{{ $image }}">
    @endif
    <link rel="alternate" type="application/rss+xml" title="{{ config('app.name') }} — Blog" href="{{ route('blog.feed') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="overflow-x-clip bg-slate-900 font-sans text-slate-100 antialiased selection:bg-indigo-500/40">

    {{-- ==================== NAVBAR ==================== --}}
    <nav class="sticky top-0 z-50 border-b border-slate-800/80 bg-slate-900/80 backdrop-blur-md" x-data="{ open: false }">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('portfolio.index') }}" class="flex items-center gap-2.5 text-lg font-bold tracking-tight">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Farhan Maulana Syidiq" width="35" height="32" style="height:32px;width:auto;" class="mix-blend-screen">
                <span>Farhan<span class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">MS</span></span>
            </a>

            {{-- Menu desktop --}}
            <div class="hidden items-center gap-6 lg:flex xl:gap-8">
                <a href="{{ route('portfolio.index') }}" class="text-sm font-medium transition {{ request()->routeIs('portfolio.index') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Beranda</a>
                <a href="{{ route('portfolio.skills') }}" class="text-sm font-medium transition {{ request()->routeIs('portfolio.skills') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Keahlian</a>
                <a href="{{ route('portfolio.projects') }}" class="text-sm font-medium transition {{ request()->routeIs('portfolio.projects') || request()->routeIs('portfolio.projects.show') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Proyek</a>
                <a href="{{ route('portfolio.experience') }}" class="text-sm font-medium transition {{ request()->routeIs('portfolio.experience') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Pengalaman</a>
                <a href="{{ route('blog.index') }}" class="text-sm font-medium transition {{ request()->routeIs('blog.*') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Blog</a>
                <a href="{{ route('portfolio.contact.show') }}" class="text-sm font-medium transition {{ request()->routeIs('portfolio.contact.show') ? 'text-cyan-300' : 'text-slate-300 hover:text-white' }}">Kontak</a>
                <a href="{{ route('search.index') }}" aria-label="Cari" title="Cari"
                   class="rounded-lg p-2 transition {{ request()->routeIs('search.index') ? 'text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                </a>
                <a href="{{ route('portfolio.contact.show') }}" class="rounded-lg bg-gradient-to-r from-indigo-500 to-cyan-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Hubungi Saya
                </a>
            </div>

            {{-- Tombol hamburger (mobile) --}}
            <button type="button" class="rounded-lg p-2 text-slate-300 transition hover:bg-slate-800 hover:text-white lg:hidden"
                    @click="open = !open" :aria-expanded="open" aria-label="Buka menu navigasi">
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Menu mobile --}}
        <div x-show="open" x-cloak x-transition.origin.top class="border-t border-slate-800/80 bg-slate-900/95 px-4 pb-4 pt-2 backdrop-blur-md lg:hidden"
             @click.away="open = false">
            <a href="{{ route('portfolio.index') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('portfolio.index') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Beranda</a>
            <a href="{{ route('portfolio.skills') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('portfolio.skills') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Keahlian</a>
            <a href="{{ route('portfolio.projects') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('portfolio.projects*') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Proyek</a>
            <a href="{{ route('portfolio.experience') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('portfolio.experience') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Pengalaman</a>
            <a href="{{ route('blog.index') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('blog.*') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Blog</a>
            <a href="{{ route('portfolio.contact.show') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('portfolio.contact.show') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Kontak</a>
            <a href="{{ route('search.index') }}" @click="open = false" class="block rounded-lg px-3 py-2.5 text-sm font-medium transition {{ request()->routeIs('search.index') ? 'bg-slate-800 text-cyan-300' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">Cari</a>
            <a href="{{ route('portfolio.contact.show') }}" @click="open = false" class="mt-2 block rounded-lg bg-gradient-to-r from-indigo-500 to-cyan-500 px-3 py-2.5 text-center text-sm font-semibold text-white shadow-lg shadow-indigo-500/25">
                Hubungi Saya
            </a>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    {{-- ==================== FOOTER ==================== --}}
    <footer class="border-t border-slate-800/60 bg-slate-950">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-4 py-10 sm:flex-row sm:px-6 lg:px-8">
            <p class="text-sm text-slate-400">
                &copy; {{ date('Y') }} Farhan Maulana Syidiq. Seluruh hak cipta dilindungi.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-5 text-sm sm:justify-end">
                <a href="{{ route('portfolio.skills') }}" class="text-slate-400 transition hover:text-cyan-300">Keahlian</a>
                <a href="{{ route('portfolio.projects') }}" class="text-slate-400 transition hover:text-cyan-300">Proyek</a>
                <a href="{{ route('portfolio.experience') }}" class="text-slate-400 transition hover:text-cyan-300">Pengalaman</a>
                <a href="{{ route('blog.index') }}" class="text-slate-400 transition hover:text-cyan-300">Blog</a>
                <a href="{{ route('portfolio.contact.show') }}" class="text-slate-400 transition hover:text-cyan-300">Kontak</a>
                <a href="{{ route('portfolio.cv') }}" class="text-slate-400 transition hover:text-cyan-300">CV</a>
            </div>
        </div>
    </footer>

    {{-- Lightbox global (sertifikat & proyek) --}}
    <div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-950/90 p-4 backdrop-blur-sm [&:not(.hidden)]:flex" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
        <button type="button" data-lightbox-close aria-label="Tutup pratinjau"
                class="absolute right-4 top-4 rounded-full border border-slate-700 bg-slate-900/80 p-2.5 text-slate-300 transition hover:border-slate-500 hover:text-white">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>
        <button type="button" data-lightbox-prev aria-label="Gambar sebelumnya"
                class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full border border-slate-700 bg-slate-900/80 p-2.5 text-slate-300 transition hover:border-slate-500 hover:text-white sm:left-6">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
            </svg>
        </button>
        <button type="button" data-lightbox-next aria-label="Gambar berikutnya"
                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full border border-slate-700 bg-slate-900/80 p-2.5 text-slate-300 transition hover:border-slate-500 hover:text-white sm:right-6">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
            </svg>
        </button>
        <figure class="max-h-full w-full max-w-4xl" data-lightbox-close>
            <img data-lightbox-image src="" alt="" class="mx-auto max-h-[80vh] w-auto max-w-full rounded-2xl border border-slate-700 object-contain shadow-2xl">
            <figcaption data-lightbox-caption class="mt-3 text-center text-sm text-slate-400"></figcaption>
        </figure>
    </div>

    {{-- x-cloak: sembunyikan elemen Alpine sebelum JS termuat --}}
    <style>[x-cloak]{display:none!important}</style>
</body>
</html>
