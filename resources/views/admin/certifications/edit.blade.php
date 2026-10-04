<x-admin-layout title="Edit Sertifikasi">
    <div class="mb-8">
        <h2 class="text-xl font-bold tracking-tight text-white">Edit Sertifikasi</h2>
        <p class="mt-1 text-sm text-slate-400">Perbarui detail sertifikat di bawah ini.</p>
    </div>

    <form method="POST" action="{{ route('admin.certifications.update', $certification) }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6 sm:p-8">
        @csrf
        @method('PUT')
        @include('admin.certifications._form', ['submitLabel' => 'Perbarui Sertifikasi'])
    </form>
</x-admin-layout>
