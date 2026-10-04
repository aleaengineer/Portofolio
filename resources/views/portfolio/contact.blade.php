<x-public-layout
    title="Kontak — Farhan Maulana Syidiq"
    description="Hubungi Farhan Maulana Syidiq untuk kolaborasi jaringan, proyek web, atau diskusi operasional ISP.">

    {{-- ==================== HEADER ==================== --}}
    <section class="border-b border-slate-800/60 bg-slate-950/40">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-400">Kontak</p>
                <h1 class="mt-3 text-balance text-3xl font-bold tracking-tight sm:text-4xl">Mari Bekerja Sama</h1>
                <p class="mt-4 text-sm leading-relaxed text-slate-400 sm:text-base">
                    Punya pertanyaan seputar jaringan, proyek web, atau sekadar ingin berdiskusi?
                    Kirimkan pesan melalui form di bawah ini.
                </p>
            </div>
        </div>
    </section>

    {{-- ==================== ISI ==================== --}}
    <section class="bg-slate-900">
        <div class="mx-auto max-w-6xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-5 lg:gap-10">
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

                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <div class="min-w-0">
                                    <label for="name" class="mb-2 block text-sm font-medium text-slate-300">Nama <span class="text-rose-400">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="100" placeholder="Nama lengkap Anda"
                                           @class(['w-full rounded-xl border bg-slate-900/60 px-4 py-3 text-sm text-white placeholder-slate-500 outline-none transition focus:ring-2',
                                               'border-slate-700 focus:border-indigo-500 focus:ring-indigo-500/30' => !$errors->has('name'),
                                               'border-rose-500/60 focus:border-rose-500 focus:ring-rose-500/30' => $errors->has('name')])>
                                    @error('name') <p class="mt-2 text-sm text-rose-400">{{ $message }}</p> @enderror
                                </div>

                                <div class="min-w-0">
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
