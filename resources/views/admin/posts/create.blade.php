<x-admin-layout title="Tulis Artikel">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Tulis Artikel Baru</h2>
        <p class="mt-1 text-sm text-slate-400">Bagikan pengalaman Anda kepada pengunjung website.</p>
    </div>

    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @include('admin.posts._form', ['submitLabel' => 'Simpan Artikel'])
    </form>
</x-admin-layout>
