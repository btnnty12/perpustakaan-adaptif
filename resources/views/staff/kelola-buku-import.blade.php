@php($title = 'Import Buku - Staff')
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#7c1d0f]">Import Excel Buku</h1>
                <p class="text-sm text-gray-700 mt-1">Unggah file Excel untuk menambah atau memperbarui data buku.</p>
            </div>
            <a href="{{ route('staff.kelola-buku') }}" class="text-sm font-semibold text-[#a63a2d] hover:underline">← Kembali ke daftar</a>
        </div>

        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <div class="flex flex-col gap-3">
                <label class="text-sm font-semibold text-gray-700">File Excel (.xlsx)</label>
                <input type="file" accept=".xlsx,.xls" class="w-full border rounded-lg px-3 py-2">
                <p class="text-xs text-gray-500">Format file: Judul, Penulis, Kategori, Tahun Terbit, Stok, Deskripsi. Unduh data buku yang ada untuk melihat format yang benar.</p>
            </div>

            <div class="flex gap-3">
                <button class="bg-[#a63a2d] text-white px-5 py-2 rounded-lg font-semibold hover:brightness-95">Upload</button>
                <a href="{{ route('staff.kelola-buku.export') }}" class="text-sm text-[#a63a2d] font-semibold hover:underline">Unduh Data Buku (Excel)</a>
            </div>
        </div>
    </section>
</x-staff-layout>

