@php($title = 'Pengaturan - Staff')
<x-staff-layout :title="$title">
    <section class="px-2 sm:px-4 pb-10 space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-[#7c1d0f]">Pengaturan Akun (Staff)</h1>
            <p class="text-sm text-gray-700 mt-1">Perbarui profil dan kredensial Anda.</p>
        </div>

        <div class="bg-white rounded-xl shadow-xl p-6 sm:p-8">
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ Auth::check() ? route('profile.update') : '#' }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @if(Auth::check()) @method('PUT') @endif

                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-amber-200 flex items-center justify-center text-amber-800 font-bold text-xl">
                        {{ strtoupper(substr(session('nama', 'ST'), 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">{{ session('nama', 'Staff') }}</div>
                        <div class="text-sm text-gray-600">{{ session('email', 'staff@example.com') }}</div>
                        <div class="text-xs text-gray-500 mt-1">Peran: Staff</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="font-semibold text-sm">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ Auth::check() ? old('nama', Auth::user()->nama) : '' }}" class="mt-1 w-full p-3 rounded border shadow-sm" {{ Auth::check() ? '' : 'disabled' }}>
                    </div>
                    <div>
                        <label class="font-semibold text-sm">Email</label>
                        <input type="email" name="email" value="{{ Auth::check() ? old('email', Auth::user()->email) : '' }}" class="mt-1 w-full p-3 rounded border shadow-sm" {{ Auth::check() ? '' : 'disabled' }}>
                    </div>
                    <div>
                        <label class="font-semibold text-sm">Kata Sandi</label>
                        <input type="password" name="kata_sandi" placeholder="Isi jika ingin ganti" class="mt-1 w-full p-3 rounded border shadow-sm" {{ Auth::check() ? '' : 'disabled' }}>
                    </div>
                    <div>
                        <label class="font-semibold text-sm">Konfirmasi Kata Sandi</label>
                        <input type="password" name="kata_sandi_confirmation" placeholder="Ulangi kata sandi" class="mt-1 w-full p-3 rounded border shadow-sm" {{ Auth::check() ? '' : 'disabled' }}>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button class="bg-[#a63a2d] text-white px-5 py-2 rounded-lg font-semibold text-sm hover:brightness-95" {{ Auth::check() ? '' : 'disabled' }}>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('staff.dashboard') }}" class="text-sm text-blue-600 font-semibold">Kembali ke Dashboard</a>
                </div>
            </form>
        </div>
    </section>
</x-staff-layout>

