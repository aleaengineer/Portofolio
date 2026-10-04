<x-public-layout
    title="404 — Halaman Tidak Ditemukan"
    description="Halaman yang Anda cari tidak ditemukan atau sudah dipindahkan.">

    <section class="relative overflow-hidden bg-slate-900">
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <div class="absolute -top-40 left-1/2 h-96 w-[90vw] max-w-[40rem] -translate-x-1/2 rounded-full bg-indigo-600/20 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-2xl px-4 py-20 text-center sm:px-6 sm:py-28">
            <p class="bg-gradient-to-r from-indigo-400 via-sky-400 to-cyan-400 bg-clip-text text-7xl font-bold text-transparent sm:text-8xl">404</p>
            <h1 class="mt-6 text-balance text-2xl font-bold tracking-tight sm:text-3xl">Halaman tidak ditemukan</h1>
            <p class="mx-auto mt-4 max-w-md text-balance text-sm leading-relaxed text-slate-400 sm:text-base">
                Alamat mungkin salah ketik, sudah dipindahkan, atau artikel/proyeknya sudah tidak tayang.
            </p>

            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('portfolio.index') }}"
                   class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-cyan-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:opacity-90 sm:w-auto">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('search.index') }}"
                   class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-slate-700 bg-slate-800/50 px-6 py-3 text-sm font-medium text-slate-200 transition hover:border-slate-500 hover:text-white sm:w-auto">
                    Cari di Situs Ini
                </a>
            </div>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm">
                <a href="{{ route('portfolio.projects') }}" class="text-slate-400 transition hover:text-cyan-300">Proyek</a>
                <a href="{{ route('portfolio.experience') }}" class="text-slate-400 transition hover:text-cyan-300">Pengalaman</a>
                <a href="{{ route('blog.index') }}" class="text-slate-400 transition hover:text-cyan-300">Blog</a>
                <a href="{{ route('portfolio.contact.show') }}" class="text-slate-400 transition hover:text-cyan-300">Kontak</a>
            </div>
        </div>
    </section>
</x-public-layout>
