@php($title = 'Tambah Buku - Staff')
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-[#7c1d0f]">Tambah Buku</h1>
                <p class="text-sm text-gray-700 mt-1">Form sederhana untuk menambahkan buku baru.</p>
            </div>
            <a href="{{ route('staff.kelola-buku') }}" class="text-sm font-semibold text-[#a63a2d] hover:underline">← Kembali ke daftar</a>
        </div>

        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
                    <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Judul buku">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
                    <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Nama penulis">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <input type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Kategori">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
                    <input type="number" class="w-full border rounded-lg px-3 py-2" placeholder="Jumlah stok" min="0">
                </div>
            </div>

            <div class="flex gap-3">
                <button class="bg-[#a63a2d] text-white px-5 py-2 rounded-lg font-semibold hover:brightness-95">Simpan</button>
                <button class="border border-gray-300 text-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-50">Batal</button>
            </div>
        </div>
    </section>
</x-staff-layout>

