<x-public-layout>
    {{-- ==================== HERO ==================== --}}
    <section id="beranda" class="relative flex scroll-mt-20 items-center overflow-hidden lg:min-h-[calc(100svh-4rem)]">
        {{-- Dekorasi latar --}}
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute -top-40 left-1/2 h-96 w-[90vw] max-w-[40rem] -translate-x-1/2 rounded-full bg-indigo-600/20 blur-3xl"></div>
            <div class="absolute right-0 top-40 h-56 w-56 rounded-full bg-cyan-500/10 blur-3xl sm:h-72 sm:w-72"></div>
        </div>

        <div class="relative mx-auto flex w-full max-w-6xl items-center px-4 py-12 sm:px-6 sm:py-16 lg:px-8 lg:py-10">
            <div class="mx-auto w-full max-w-3xl text-center" data-reveal>
                {{-- Badge status --}}
                <div class="mb-6 inline-flex max-w-full flex-wrap items-center justify-center gap-2 rounded-full border border-emerald-500/30 bg-emerald-500/10 px-3 py-1.5 text-xs font-medium text-emerald-400 sm:px-4 sm:text-sm">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                    </span>
                    Terbuka untuk kolaborasi & proyek
                </div>

                <h1 class="text-balance break-words text-3xl font-bold leading-tight tracking-tight sm:text-5xl md:text-6xl">
                    Halo, saya
                    <span class="block bg-gradient-to-r from-indigo-400 via-sky-400 to-cyan-400 bg-clip-text pb-2 text-transparent">
                        Farhan Maulana Syidiq
                    </span>
                </h1>

                <p class="mx-auto mt-5 max-w-2xl text-balance text-base leading-relaxed text-slate-300 sm:mt-6 sm:text-lg md:text-xl">
                    NOC Engineer &amp; Network Administrator yang membangun aplikasi web untuk efisiensi operasional ISP.
                </p>

                {{-- Badge peran --}}
                <div class="mt-6 flex flex-wrap items-center justify-center gap-2 sm:mt-8 sm:gap-3">
                    <span class="inline-flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/60 px-3.5 py-1.5 text-sm font-medium text-slate-200">
                        <span class="h-2 w-2 rounded-full bg-indigo-400"></span> NOC Engineer
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/60 px-3.5 py-1.5 text-sm font-medium text-slate-200">
                        <span class="h-2 w-2 rounded-full bg-cyan-400"></span> Network Administrator
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-lg border border-slate-700 bg-slate-800/60 px-3.5 py-1.5 text-sm font-medium text-slate-200">
                        <span class="h-2 w-2 rounded-full bg-sky-400"></span> Web Developer
                    </span>
                </div>

                {{-- Tombol CTA --}}
                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:mt-10 sm:flex-row sm:gap-4">
                    <a href="{{ route('portfolio.projects') }}" class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-8 py-3.5 text-center text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90 sm:w-auto">
                        Lihat Proyek Saya
                    </a>
                    <a href="{{ route('portfolio.contact.show') }}" class="w-full rounded-xl border border-cyan-400/40 bg-cyan-400/5 px-8 py-3.5 text-center text-sm font-semibold text-cyan-300 transition hover:border-cyan-300 hover:bg-cyan-400/10 sm:w-auto">
                        Hubungi Saya
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== STATISTIK ==================== --}}
    <section class="border-t border-slate-800/60 bg-slate-950/60" aria-label="Statistik ringkas">
        <div class="mx-auto grid max-w-6xl grid-cols-2 gap-6 px-4 py-10 sm:px-6 lg:grid-cols-4 lg:px-8" data-reveal>
            <div class="text-center">
                <p class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-3xl font-bold text-transparent sm:text-4xl">
                    <span data-count-to="{{ $stats['years'] ?? 0 }}">0</span>+
                </p>
                <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 sm:text-sm">Tahun Pengalaman</p>
            </div>
            <div class="text-center">
                <p class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-3xl font-bold text-transparent sm:text-4xl">
                    <span data-count-to="{{ $stats['projects'] ?? 0 }}">0</span>
                </p>
                <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 sm:text-sm">Proyek Unggulan</p>
            </div>
            <div class="text-center">
                <p class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-3xl font-bold text-transparent sm:text-4xl">
                    <span data-count-to="{{ $stats['posts'] ?? 0 }}">0</span>
                </p>
                <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 sm:text-sm">Artikel Blog</p>
            </div>
            <div class="text-center">
                <p class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-3xl font-bold text-transparent sm:text-4xl">
                    <span data-count-to="{{ $stats['certifications'] ?? 0 }}">0</span>
                </p>
                <p class="mt-1.5 text-xs font-medium uppercase tracking-wider text-slate-500 sm:text-sm">Sertifikasi</p>
            </div>
        </div>
    </section>

    {{-- ==================== KEAHLIAN ==================== --}}
    <section id="keahlian" class="scroll-mt-20 border-t border-slate-800/60 bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Keahlian</p>
                <h2 class="mt-3 text-balance text-2xl font-bold tracking-tight sm:text-3xl lg:text-4xl">Bidang yang Saya Geluti</h2>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Kombinasi antara operasional jaringan tingkat operator, administrasi infrastruktur,
                    dan pengembangan aplikasi internal.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 sm:mt-14 md:grid-cols-3" data-reveal>
                {{-- Kartu 1: Networking --}}
                <div class="group min-w-0 rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-indigo-500/40 hover:bg-slate-800/60 sm:p-8">
                    <div class="mb-5 inline-flex rounded-xl bg-indigo-500/10 p-3 text-indigo-400 ring-1 ring-indigo-500/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Networking</h3>
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
                    <h3 class="text-lg font-semibold text-white">Server &amp; DevOps</h3>
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
                    <h3 class="text-lg font-semibold text-white">Web Development</h3>
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
        </div>
    </section>

    {{-- ==================== PROYEK ==================== --}}
    <section id="proyek" class="scroll-mt-20 border-t border-slate-800/60 bg-slate-950/60">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="text-sm font-semibold uppercase tracking-widest text-indigo-400">Portofolio</p>
                <h2 class="mt-3 text-balance text-2xl font-bold tracking-tight sm:text-3xl lg:text-4xl">Proyek Unggulan</h2>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Kumpulan proyek yang pernah saya kerjakan — dari pemetaan infrastruktur jaringan hingga otomasi operasional.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-6 sm:mt-14 sm:gap-8 md:grid-cols-2 lg:grid-cols-3" data-reveal>
                @forelse ($projects as $project)
                    <article class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40 transition hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-xl hover:shadow-indigo-500/10">
                        {{-- Thumbnail / placeholder --}}
                        <a href="{{ route('portfolio.projects.show', $project) }}" class="block aspect-video overflow-hidden bg-slate-800">
                            @if ($project->thumbnail_url)
                                <img src="{{ $project->thumbnail_url }}" alt="Thumbnail proyek {{ $project->title }}"
                                     class="h-full w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                            @else
                                <span class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-800 via-slate-800/60 to-indigo-900/30">
                                    <svg class="h-12 w-12 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A1.5 1.5 0 0 0 21.75 19.5V4.5A1.5 1.5 0 0 0 20.25 3H3.75A1.5 1.5 0 0 0 2.25 4.5v15A1.5 1.5 0 0 0 3.75 21Z"/>
                                    </svg>
                                </span>
                            @endif
                        </a>

                        <div class="flex flex-1 flex-col p-6">
                            <h3 class="break-words text-lg font-semibold text-white transition group-hover:text-indigo-300">
                                <a href="{{ route('portfolio.projects.show', $project) }}">{{ $project->title }}</a>
                            </h3>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-400">
                                {{ $project->excerpt() }}
                            </p>

                            {{-- Badge tech stack --}}
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ((array) $project->tech_stack as $tech)
                                    <span class="rounded-md border border-indigo-500/30 bg-indigo-500/10 px-2.5 py-1 text-xs font-medium text-indigo-300">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>

                            {{-- Tombol link --}}
                            <div class="mt-6 flex gap-3">
                                @if ($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-slate-700 bg-slate-900/50 px-4 py-2.5 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844a9.59 9.59 0 0 1 2.504.337c1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.02 10.02 0 0 0 22 12.017C22 6.484 17.522 2 12 2Z"/>
                                        </svg>
                                        GitHub
                                    </a>
                                @endif
                                @if ($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-cyan-400/40 bg-cyan-400/5 px-4 py-2.5 text-sm font-medium text-cyan-300 transition hover:border-cyan-300 hover:bg-cyan-400/10">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                        </svg>
                                        Live Demo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-8 text-center sm:p-14">
                        <p class="text-sm text-slate-400 sm:text-base">Belum ada proyek unggulan untuk ditampilkan. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ==================== KONTAK ==================== --}}
    <section id="kontak" class="scroll-mt-20 border-t border-slate-800/60 bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Kontak</p>
                <h2 class="mt-3 text-balance text-2xl font-bold tracking-tight sm:text-3xl lg:text-4xl">Mari Bekerja Sama</h2>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Punya pertanyaan seputar jaringan, proyek web, atau sekadar ingin berdiskusi?
                    Kirimkan pesan melalui form di bawah ini.
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-8 sm:mt-14 lg:grid-cols-5 lg:gap-10" data-reveal>
                {{-- Info kontak --}}
                <div class="min-w-0 space-y-5 sm:space-y-6 lg:col-span-2">
                    <div class="flex min-w-0 items-start gap-4 rounded-2xl border border-slate-800 bg-slate-800/40 p-5 sm:p-6">
                        <div class="rounded-xl bg-indigo-500/10 p-3 text-indigo-400 ring-1 ring-indigo-500/30">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-400">Email</p>
                            <a href="mailto:{{ ($contactSetting ?? null)?->email ?? 'farhanmsyidiq@gmail.com' }}" class="mt-1 block break-all font-medium text-white transition hover:text-cyan-300">{{ ($contactSetting ?? null)?->email ?? 'farhanmsyidiq@gmail.com' }}</a>
                        </div>
                    </div>

                    <div class="flex min-w-0 items-start gap-4 rounded-2xl border border-slate-800 bg-slate-800/40 p-5 sm:p-6">
                        <div class="rounded-xl bg-cyan-500/10 p-3 text-cyan-400 ring-1 ring-cyan-500/30">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-400">Lokasi</p>
                            <p class="mt-1 font-medium text-white">{{ ($contactSetting ?? null)?->location ?? 'Indonesia — Remote Friendly' }}</p>
                        </div>
                    </div>

                    <div class="flex min-w-0 items-start gap-4 rounded-2xl border border-slate-800 bg-slate-800/40 p-5 sm:p-6">
                        <div class="rounded-xl bg-sky-500/10 p-3 text-sky-400 ring-1 ring-sky-500/30">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-400">Jam Respons</p>
                            <p class="mt-1 font-medium text-white">{{ ($contactSetting ?? null)?->response_hours ?? 'Senin – Sabtu, 09.00 – 21.00 WIB' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Form kontak --}}
                <div class="min-w-0 lg:col-span-3">
                    <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6 sm:p-8">
                        {{-- Flash sukses --}}
                        @if (session('success'))
                            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 6000)"
                                 class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4" role="alert">
                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <p class="text-sm font-medium text-emerald-300">{{ session('success') }}</p>
                                <button type="button" @click="show = false" class="ml-auto text-emerald-400/60 transition hover:text-emerald-300" aria-label="Tutup notifikasi">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('portfolio.contact') }}" class="space-y-5">
                            @csrf

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="mb-2 block text-sm font-medium text-slate-300">Nama <span class="text-rose-400">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="100" placeholder="Nama lengkap Anda"
                                           @class(['w-full rounded-xl border bg-slate-900/60 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:ring-2',
                                               'border-slate-700 focus:border-indigo-500 focus:ring-indigo-500/30' => !$errors->has('name'),
                                               'border-rose-500/60 focus:border-rose-500 focus:ring-rose-500/30' => $errors->has('name')])>
                                    @error('name') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Email <span class="text-rose-400">*</span></label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="150" placeholder="nama@email.com"
                                           @class(['w-full rounded-xl border bg-slate-900/60 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:ring-2',
                                               'border-slate-700 focus:border-indigo-500 focus:ring-indigo-500/30' => !$errors->has('email'),
                                               'border-rose-500/60 focus:border-rose-500 focus:ring-rose-500/30' => $errors->has('email')])>
                                    @error('email') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="mb-2 block text-sm font-medium text-slate-300">Subjek <span class="text-rose-400">*</span></label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required maxlength="200" placeholder="Judul pesan Anda"
                                       @class(['w-full rounded-xl border bg-slate-900/60 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:ring-2',
                                           'border-slate-700 focus:border-indigo-500 focus:ring-indigo-500/30' => !$errors->has('subject'),
                                           'border-rose-500/60 focus:border-rose-500 focus:ring-rose-500/30' => $errors->has('subject')])>
                                @error('subject') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="message" class="mb-2 block text-sm font-medium text-slate-300">Pesan <span class="text-rose-400">*</span></label>
                                <textarea id="message" name="message" rows="5" required maxlength="5000" placeholder="Tulis pesan, pertanyaan, atau proposal kerja sama Anda di sini…"
                                          @class(['w-full resize-y rounded-xl border bg-slate-900/60 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:ring-2',
                                              'border-slate-700 focus:border-indigo-500 focus:ring-indigo-500/30' => !$errors->has('message'),
                                              'border-rose-500/60 focus:border-rose-500 focus:ring-rose-500/30' => $errors->has('message')])>{{ old('message') }}</textarea>
                                @error('message') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90 sm:w-auto">
                                Kirim Pesan
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
