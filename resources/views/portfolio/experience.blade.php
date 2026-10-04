<x-public-layout
    title="Pengalaman — Farhan Maulana Syidiq"
    description="Riwayat pengalaman kerja dan sertifikasi Farhan Maulana Syidiq: NOC Engineer, Network Administrator, dan Web Developer.">

    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Pengalaman</p>
                <h1 class="mt-3 text-balance text-3xl font-bold tracking-tight sm:text-4xl">Riwayat &amp; Sertifikasi</h1>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Perjalanan profesional di operasional jaringan ISP dan pengembangan aplikasi internal.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-slate-900">
        <div class="mx-auto max-w-6xl space-y-14 px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            {{-- Pengalaman kerja --}}
            <div>
                <h2 class="text-xl font-bold tracking-tight">Pengalaman Kerja</h2>
                @if ($experiences->isEmpty())
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-8 text-center sm:p-12">
                        <p class="text-sm text-slate-400 sm:text-base">Belum ada riwayat pengalaman yang ditampilkan.</p>
                    </div>
                @else
                    <ol class="relative mt-8 space-y-6 border-l-2 border-slate-800 pl-6 sm:pl-8" data-reveal>
                        @foreach ($experiences as $experience)
                            <li class="relative">
                                {{-- Dot timeline --}}
                                <span class="absolute -left-[33px] top-6 flex h-4 w-4 items-center justify-center rounded-full border-2 border-cyan-400/60 bg-slate-900 sm:-left-[41px]" aria-hidden="true">
                                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-400"></span>
                                </span>
                                <a href="{{ route('portfolio.experience.show', $experience) }}"
                                   class="group block rounded-2xl border border-slate-800 bg-slate-800/40 p-5 transition hover:-translate-y-0.5 hover:border-cyan-500/30 hover:bg-slate-800/60 hover:shadow-xl hover:shadow-cyan-500/10 sm:p-6">
                                    <span class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <span class="min-w-0">
                                            <span class="block break-words font-semibold text-white transition group-hover:text-cyan-300">{{ $experience->position }}</span>
                                            <span class="mt-0.5 block truncate text-sm text-slate-400">
                                                {{ $experience->company }}{{ $experience->location ? ' — '.$experience->location : '' }}
                                            </span>
                                            @if ($experience->description)
                                                <span class="mt-1.5 block text-sm leading-relaxed text-slate-500">
                                                    {{ $experience->excerpt(110) }}
                                                </span>
                                            @endif
                                        </span>
                                        <span class="flex shrink-0 items-center gap-3">
                                            <span class="inline-flex items-center rounded-full border border-slate-700 bg-slate-900/60 px-3 py-1 text-xs font-medium text-slate-300">
                                                {{ $experience->period }}
                                            </span>
                                            <svg class="h-4 w-4 text-slate-500 transition group-hover:translate-x-0.5 group-hover:text-cyan-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                            </svg>
                                        </span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>

            {{-- Pendidikan --}}
            <div>
                <h2 class="text-xl font-bold tracking-tight">Pendidikan</h2>
                @if (($educations ?? collect())->isEmpty())
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-8 text-center sm:p-12">
                        <p class="text-sm text-slate-400 sm:text-base">Belum ada riwayat pendidikan yang ditampilkan.</p>
                    </div>
                @else
                    <ol class="relative mt-8 space-y-6 border-l-2 border-slate-800 pl-6 sm:pl-8" data-reveal>
                        @foreach ($educations as $education)
                            <li class="relative">
                                <span class="absolute -left-[33px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full border-2 border-indigo-400/60 bg-slate-900 sm:-left-[41px]" aria-hidden="true">
                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                                </span>
                                <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-5 sm:p-6">
                                    <h3 class="break-words font-semibold text-white">{{ $education->institution }}</h3>
                                    @if ($education->degree)
                                        <p class="mt-0.5 text-sm text-slate-400">{{ $education->degree }}</p>
                                    @endif
                                    <p class="mt-2 inline-flex items-center rounded-full border border-slate-700 bg-slate-900/60 px-3 py-1 text-xs font-medium text-slate-300">
                                        {{ $education->period }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </div>

            {{-- Sertifikasi --}}
            <div>
                <h2 class="text-xl font-bold tracking-tight">Sertifikasi</h2>
                @if ($certifications->isEmpty())
                    <div class="mt-6 rounded-2xl border border-dashed border-slate-700 bg-slate-800/20 p-8 text-center sm:p-12">
                        <p class="text-sm text-slate-400 sm:text-base">Belum ada sertifikasi yang ditampilkan.</p>
                    </div>
                @else
                    <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($certifications as $certification)
                            <div class="flex min-w-0 flex-col overflow-hidden rounded-2xl border border-slate-800 bg-slate-800/40 transition hover:border-cyan-500/30" data-reveal>
                                @if ($certification->image_url)
                                    <a href="{{ $certification->image_url }}"
                                       data-lightbox="{{ $certification->image_url }}"
                                       data-lightbox-group="certifications"
                                       data-lightbox-caption="{{ $certification->name }} — {{ $certification->issuer }}"
                                       class="block aspect-video cursor-zoom-in overflow-hidden bg-slate-800" title="Klik untuk memperbesar">
                                        <img src="{{ $certification->image_url }}" alt="Sertifikat {{ $certification->name }}"
                                             class="h-full w-full object-cover transition duration-300 hover:scale-105" loading="lazy">
                                    </a>
                                @endif
                                <div class="flex flex-1 flex-col p-6">
                                    <h3 class="break-words text-base font-semibold text-white">{{ $certification->name }}</h3>
                                    <p class="mt-1 text-sm text-slate-400">{{ $certification->issuer }}</p>
                                    <p class="mt-3 text-xs text-slate-500">
                                        Terbit: {{ $certification->issue_date?->translatedFormat('M Y') ?? '-' }}
                                        @if ($certification->expiry_date)
                                            &middot; Berlaku s.d. {{ $certification->expiry_date->translatedFormat('M Y') }}
                                        @endif
                                    </p>
                                    @if ($certification->credential_id)
                                        <p class="mt-1 break-all text-xs text-slate-500">ID: {{ $certification->credential_id }}</p>
                                    @endif
                                    @if ($certification->credential_url)
                                        <a href="{{ $certification->credential_url }}" target="_blank" rel="noopener noreferrer"
                                           class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-400 transition hover:text-cyan-300">
                                            Verifikasi kredensial
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-public-layout>
