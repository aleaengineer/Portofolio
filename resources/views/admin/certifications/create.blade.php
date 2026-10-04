<x-admin-layout title="Tambah Sertifikasi">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Tambah Sertifikasi</h2>
        <p class="mt-1 text-sm text-slate-400">Lengkapi detail sertifikat di bawah ini.</p>
    </div>

    <form method="POST" action="{{ route('admin.certifications.store') }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @include('admin.certifications._form', ['submitLabel' => 'Simpan Sertifikasi'])
    </form>
</x-admin-layout>
