<x-admin-layout title="Dashboard">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Kartu: total proyek --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <div class="mb-4 inline-flex rounded-xl bg-indigo-500/10 p-3 text-indigo-400 ring-1 ring-indigo-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalProjects }}</p>
            <p class="mt-1 text-sm text-slate-400">Total Proyek</p>
        </div>

        {{-- Kartu: blog --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <div class="mb-4 inline-flex rounded-xl bg-violet-500/10 p-3 text-violet-400 ring-1 ring-violet-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $publishedPosts }}<span class="text-lg font-medium text-slate-500">/{{ $totalPosts }}</span></p>
            <p class="mt-1 text-sm text-slate-400">Artikel Terbit</p>
        </div>

        {{-- Kartu: proyek unggulan --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <div class="mb-4 inline-flex rounded-xl bg-cyan-500/10 p-3 text-cyan-400 ring-1 ring-cyan-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $featuredProjects }}</p>
            <p class="mt-1 text-sm text-slate-400">Tampil di Halaman Publik</p>
        </div>

        {{-- Kartu: total pesan --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-800/40 p-6">
            <div class="mb-4 inline-flex rounded-xl bg-sky-500/10 p-3 text-sky-400 ring-1 ring-sky-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalMessages }}</p>
            <p class="mt-1 text-sm text-slate-400">Total Pesan Masuk</p>
        </div>

        {{-- Kartu: pesan belum dibaca --}}
        <div class="rounded-2xl border p-6 {{ $unreadMessages > 0 ? 'border-rose-500/40 bg-rose-500/5' : 'border-slate-800 bg-slate-800/40' }}">
            <div class="mb-4 inline-flex rounded-xl p-3 ring-1 {{ $unreadMessages > 0 ? 'bg-rose-500/10 text-rose-400 ring-rose-500/30' : 'bg-slate-500/10 text-slate-400 ring-slate-500/30' }}">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $unreadMessages }}</p>
            <p class="mt-1 text-sm text-slate-400">Pesan Belum Dibaca</p>
        </div>

        {{-- Kartu: pengalaman --}}
        <a href="{{ route('admin.experiences.index') }}" class="block rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-amber-500/40">
            <div class="mb-4 inline-flex rounded-xl bg-amber-500/10 p-3 text-amber-400 ring-1 ring-amber-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalExperiences }}</p>
            <p class="mt-1 text-sm text-slate-400">Pengalaman Kerja</p>
        </a>

        {{-- Kartu: sertifikasi --}}
        <a href="{{ route('admin.certifications.index') }}" class="block rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-emerald-500/40">
            <div class="mb-4 inline-flex rounded-xl bg-emerald-500/10 p-3 text-emerald-400 ring-1 ring-emerald-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalCertifications }}</p>
            <p class="mt-1 text-sm text-slate-400">Sertifikasi</p>
        </a>

        {{-- Kartu: pendidikan --}}
        <a href="{{ route('admin.educations.index') }}" class="block rounded-2xl border border-slate-800 bg-slate-800/40 p-6 transition hover:border-violet-500/40">
            <div class="mb-4 inline-flex rounded-xl bg-violet-500/10 p-3 text-violet-400 ring-1 ring-violet-500/30">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.659 50.659 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                </svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $totalEducations }}</p>
            <p class="mt-1 text-sm text-slate-400">Pendidikan</p>
        </a>
    </div>

    {{-- Pesan terbaru --}}
    <div class="mt-10 rounded-2xl border border-slate-800 bg-slate-800/40">
        <div class="flex items-center justify-between border-b border-slate-800 px-6 py-4">
            <h2 class="font-semibold text-white">Pesan Terbaru</h2>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-medium text-indigo-400 transition hover:text-indigo-300">Lihat semua &rarr;</a>
        </div>

        @if ($latestMessages->isEmpty())
            <p class="px-6 py-10 text-center text-sm text-slate-500">Belum ada pesan masuk.</p>
        @else
            <ul class="divide-y divide-slate-800/70">
                @foreach ($latestMessages as $message)
                    <li class="flex items-center gap-4 px-6 py-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500/30 to-cyan-500/30 text-sm font-semibold text-indigo-300">
                            {{ strtoupper(substr($message->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium {{ $message->is_read ? 'text-slate-400' : 'text-white' }}">
                                {{ $message->name }} <span class="font-normal text-slate-500">&lt;{{ $message->email }}&gt;</span>
                            </p>
                            <p class="truncate text-sm text-slate-500">{{ $message->subject }}</p>
                        </div>
                        <span class="shrink-0 text-xs text-slate-600">{{ $message->created_at?->format('d M Y H:i') }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Aksi cepat --}}
    <div class="mt-10 flex flex-wrap gap-4">
        <a href="{{ route('admin.projects.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Tambah Proyek Baru
        </a>
        <a href="{{ route('admin.posts.create') }}"
           class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-5 py-3 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
            Tulis Artikel
        </a>
        <a href="{{ route('admin.experiences.create') }}"
           class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-5 py-3 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
            Tambah Pengalaman
        </a>
        <a href="{{ route('portfolio.index') }}" target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-5 py-3 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white">
            Pratinjau Halaman Publik
        </a>
    </div>
</x-admin-layout>
