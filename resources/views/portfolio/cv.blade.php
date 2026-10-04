<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CV Farhan Maulana Syidiq — NOC Engineer, Network Administrator & Web Developer.">
    <title>CV — Farhan Maulana Syidiq</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @page { size: A4; margin: 10mm; }
        @media print {
            body { background: #fff !important; }
            a { text-decoration: none; }
            * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            /* Padatkan agar muat 1 halaman A4 */
            #cv-sheet { zoom: 0.8; }
        }
    </style>
</head>
<body class="bg-slate-900 font-sans antialiased">

    {{-- Toolbar layar (disembunyikan saat cetak) --}}
    <div class="mx-auto flex max-w-4xl flex-col gap-3 px-4 py-6 sm:flex-row sm:items-center sm:justify-between sm:px-6 print:hidden">
        <a href="{{ route('portfolio.experience') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-cyan-300">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
            Kembali
        </a>
        <button type="button" onclick="window.print()"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.111 48.111 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
            </svg>
            Cetak / Simpan PDF
        </button>
    </div>

    {{-- Lembar CV --}}
    <main id="cv-sheet" class="mx-auto mb-10 max-w-4xl sm:px-6 print:mb-0 print:max-w-none print:px-0">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-2xl print:rounded-none print:shadow-none">

            {{-- Kepala: navy + foto --}}
            <div class="bg-[#1c2547] px-7 py-8 sm:px-10">
                <div class="flex flex-col-reverse items-start gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div class="min-w-0">
                        <h1 class="text-4xl font-extrabold leading-none tracking-tight sm:text-5xl">
                            <span class="block text-[#f2591f]">Farhan</span>
                            <span class="mt-1 block text-white">Maulana Syidiq</span>
                        </h1>
                        <p class="mt-4 inline-block rounded-full bg-[#f2591f] px-6 py-2 text-xs font-bold uppercase tracking-[0.25em] text-white sm:text-sm">
                            Network Engineer
                        </p>
                        <ul class="mt-6 space-y-1.5 text-xs text-slate-200 sm:text-sm">
                            @if ($contactSetting?->phone ?? \App\Models\ContactSetting::defaults()['phone'])
                                <li>{{ $contactSetting?->phone ?? \App\Models\ContactSetting::defaults()['phone'] }}</li>
                            @endif
                            <li>{{ $contactSetting?->email ?? 'farhanmsyidiq@gmail.com' }}</li>
                            <li>{{ url('/') }}</li>
                            <li>{{ $contactSetting?->location ?? 'Indonesia — Remote Friendly' }}</li>
                        </ul>
                    </div>
                    <div class="h-64 w-48 shrink-0 overflow-hidden rounded-full ring-4 ring-[#f2591f] sm:h-80 sm:w-60">
                        <img src="{{ asset('images/cv-photo.jpg') }}" alt="Foto Farhan Maulana Syidiq"
                             class="h-full w-full object-cover object-top">
                    </div>
                </div>
            </div>

            {{-- Isi dua kolom --}}
            <div class="grid gap-8 px-7 py-8 sm:px-10 md:grid-cols-5 print:grid-cols-5 print:gap-6 print:px-8 print:py-6">
                <div class="space-y-8 md:col-span-3 print:col-span-3 print:space-y-5">
                    {{-- Pengalaman --}}
                    @if ($experiences->isNotEmpty())
                        <section>
                            <h2 class="inline-block rounded-full bg-[#f2591f] px-6 py-2 text-sm font-bold text-white">Pengalaman</h2>
                            <ol class="mt-5 space-y-4 border-l-2 border-[#f2591f]/40 pl-5">
                                @foreach ($experiences as $experience)
                                    <li class="relative break-inside-avoid">
                                        <span class="absolute -left-[27px] top-1 h-3 w-3 rounded-full bg-[#f2591f]" aria-hidden="true"></span>
                                        <h3 class="font-bold text-slate-900">{{ $experience->position }}</h3>
                                        <p class="text-sm font-medium text-[#f2591f]">{{ $experience->company }}</p>
                                        <p class="text-xs text-slate-500">{{ $experience->period }}{{ $experience->location ? ' — '.$experience->location : '' }}</p>
                                    </li>
                                @endforeach
                            </ol>
                        </section>
                    @endif

                    {{-- Proyek --}}
                    @if ($projects->isNotEmpty())
                        <section>
                            <h2 class="inline-block rounded-full bg-[#f2591f] px-6 py-2 text-sm font-bold text-white">Proyek Unggulan</h2>
                            <div class="mt-4 space-y-3">
                                @foreach ($projects as $project)
                                    <div class="break-inside-avoid text-sm">
                                        <p class="font-bold text-slate-900">{{ $project->title }}</p>
                                        <p class="mt-0.5 leading-relaxed text-slate-700">{{ $project->excerpt(200) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <div class="space-y-8 md:col-span-2 print:col-span-2 print:space-y-5">
                    {{-- Pendidikan --}}
                    @if (($educations ?? collect())->isNotEmpty())
                        <section>
                            <h2 class="inline-block rounded-full bg-[#f2591f] px-6 py-2 text-sm font-bold text-white">Pendidikan</h2>
                            <ul class="mt-4 space-y-2.5">
                                @foreach ($educations as $education)
                                    <li class="break-inside-avoid text-sm">
                                        <p class="font-bold text-slate-900">{{ $education->institution }}</p>
                                        <p class="text-slate-600">{{ $education->degree }}{{ $education->start_date ? ' — '.$education->period : '' }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Sertifikasi --}}
                    @if ($certifications->isNotEmpty())
                        <section>
                            <h2 class="inline-block rounded-full bg-[#f2591f] px-6 py-2 text-sm font-bold text-white">Sertifikasi</h2>
                            <ul class="mt-4 space-y-2.5">
                                @foreach ($certifications as $certification)
                                    <li class="break-inside-avoid text-sm">
                                        <p class="font-bold text-slate-900">{{ $certification->name }}</p>
                                        <p class="text-slate-600">{{ $certification->issuer }}{{ $certification->issue_date ? ' — '.$certification->issue_date->translatedFormat('Y') : '' }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Keahlian --}}
                    <section>
                        <h2 class="inline-block rounded-full bg-[#f2591f] px-6 py-2 text-sm font-bold text-white">Keahlian</h2>
                        <ul class="mt-4 space-y-1.5 text-sm text-slate-700">
                            <li>Network Engineer</li>
                            <li>Network Administration</li>
                            <li>Server &amp; DevOps</li>
                            <li>Web Development (Laravel)</li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
        <p class="mt-4 text-center text-xs text-slate-500 print:hidden">Gunakan “Simpan sebagai PDF” pada dialog cetak untuk hasil terbaik.</p>
    </main>
</body>
</html>
