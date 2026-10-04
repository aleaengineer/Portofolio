<x-public-layout
    title="Keahlian — Farhan Maulana Syidiq"
    description="Bidang keahlian Farhan Maulana Syidiq: Networking, Server & DevOps, dan Web Development.">

    {{-- ==================== HEADER ==================== --}}
    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Keahlian</p>
                <h1 class="mt-3 text-balance text-3xl font-bold tracking-tight sm:text-4xl">Bidang yang Saya Geluti</h1>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Kombinasi antara operasional jaringan tingkat operator, administrasi infrastruktur,
                    dan pengembangan aplikasi internal.
                </p>
            </div>
        </div>
    </section>

    {{-- ==================== ISI ==================== --}}
    <section class="bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                {{-- Kartu 1: Networking --}}
                <div class="group min-w-0 rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-indigo-500/40 hover:bg-slate-800/60 sm:p-8">
                    <div class="mb-5 inline-flex rounded-xl bg-indigo-500/10 p-3 text-indigo-400 ring-1 ring-indigo-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Networking</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">
                        Operasional dan monitoring jaringan FTTH skala ISP, routing, switching, dan manajemen perangkat akses.
                    </p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach (['MikroTik RouterOS v6/v7', 'OLT GPON/EPON ZTE', 'OLT HiOSO', 'Routing & Switching', 'Monitoring Jaringan'] as $skill)
                            <span class="rounded-md border border-slate-700 bg-slate-900/60 px-2.5 py-1 text-xs font-medium text-slate-300">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Kartu 2: Server & DevOps --}}
                <div class="group min-w-0 rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-cyan-500/40 hover:bg-slate-800/60 sm:p-8">
                    <div class="mb-5 inline-flex rounded-xl bg-cyan-500/10 p-3 text-cyan-400 ring-1 ring-cyan-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.737 5.1a3.375 3.375 0 0 1 2.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 0 1 .9 2.7m0 0a3 3 0 0 1-3 3m0 3h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Zm-3 6h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Server &amp; DevOps</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">
                        Virtualisasi, deployment, dan hardening server Linux untuk layanan produksi.
                    </p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach (['Proxmox VE', 'Debian / Ubuntu Server', 'Nginx', 'PHP-FPM', 'Bash Scripting'] as $skill)
                            <span class="rounded-md border border-slate-700 bg-slate-900/60 px-2.5 py-1 text-xs font-medium text-slate-300">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Kartu 3: Web Development --}}
                <div class="group min-w-0 rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-sky-500/40 hover:bg-slate-800/60 sm:p-8">
                    <div class="mb-5 inline-flex rounded-xl bg-sky-500/10 p-3 text-sky-400 ring-1 ring-sky-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Web Development</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">
                        Pembuatan aplikasi web dan tools internal, dari desain UI hingga integrasi database dan API perangkat.
                    </p>
                    <div class="mt-5 flex flex-wrap gap-2">
                        @foreach (['Laravel', 'Python', 'Tailwind CSS', 'Alpine.js', 'Leaflet.js', 'MySQL'] as $skill)
                            <span class="rounded-md border border-slate-700 bg-slate-900/60 px-2.5 py-1 text-xs font-medium text-slate-300">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('portfolio.projects') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
                    Lihat Proyek Saya
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
