<x-public-layout
    title="Proyek — Farhan Maulana Syidiq"
    description="Kumpulan proyek Farhan Maulana Syidiq: pemetaan infrastruktur FTTH, otomasi provisioning ONU, dan monitoring NOC.">

    {{-- ==================== HEADER ==================== --}}
    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-indigo-400">Portofolio</p>
                <h1 class="mt-3 text-balance text-3xl font-bold tracking-tight sm:text-4xl">Semua Proyek</h1>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Kumpulan proyek yang pernah saya kerjakan — dari pemetaan infrastruktur jaringan hingga otomasi operasional.
                </p>
            </div>
        </div>
    </section>

    {{-- ==================== DAFTAR PROYEK ==================== --}}
    <section class="bg-slate-950/60">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($projects as $project)
                    <article class="group flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40 transition hover:-translate-y-1 hover:border-indigo-500/40 hover:shadow-xl hover:shadow-indigo-500/10">
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
                            <h2 class="break-words text-lg font-semibold text-white transition group-hover:text-indigo-300">
                                <a href="{{ route('portfolio.projects.show', $project) }}">{{ $project->title }}</a>
                            </h2>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-400">
                                {{ $project->excerpt() }}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ((array) $project->tech_stack as $tech)
                                    <span class="rounded-md border border-indigo-500/30 bg-indigo-500/10 px-2.5 py-1 text-xs font-medium text-indigo-300">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="mt-6 flex gap-3">
                                @if ($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-slate-700 bg-slate-900/50 px-4 py-2.5 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
                                        GitHub
                                    </a>
                                @endif
                                @if ($project->demo_url)
                                    <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-cyan-400/40 bg-cyan-400/5 px-4 py-2.5 text-sm font-medium text-cyan-300 transition hover:border-cyan-300 hover:bg-cyan-400/10">
                                        Live Demo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-8 text-center sm:p-14">
                        <p class="text-sm text-slate-400 sm:text-base">Belum ada proyek untuk ditampilkan. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('portfolio.contact.show') }}" class="inline-flex items-center gap-2 rounded-xl border border-cyan-400/40 bg-cyan-400/5 px-6 py-3 text-sm font-semibold text-cyan-300 transition hover:border-cyan-300 hover:bg-cyan-400/10">
                    Hubungi Saya
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
