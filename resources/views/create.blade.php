<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS terpisah -->
    <link rel="stylesheet" href="/css/peminjaman.css">
</head>
<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white p-8 rounded-2xl shadow">

            <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-3 mb-6">
                <i class="fas fa-book-open text-blue-600 text-3xl"></i>
                Form Peminjaman Buku
            </h2>

            <!-- FORM TANPA ROUTE -->
            <form>

                <div class="grid grid-cols-1 gap-5">

                    <div>
                        <label class="font-semibold text-gray-700">Nama Peminjam</label>
                        <input type="text" class="input-field" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Judul Buku</label>
                        <input type="text" class="input-field" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Tanggal Pinjam</label>
                        <input type="date" class="input-field" required>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-700">Tanggal Kembali</label>
                        <input type="date" class="input-field" required>
                    </div>

                </div>

                <div class="flex justify-end gap-3 mt-8">

                    <!-- BATAL (BALIK HALAMAN) -->
                    <button type="button" class="btn-cancel" onclick="history.back()">
                        <i class="fas fa-xmark"></i> Batal
                    </button>

                    <!-- AJUKAN (SUBMIT FORM) -->
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Ajukan Peminjaman
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>
</html>