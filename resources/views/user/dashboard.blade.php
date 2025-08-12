<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('layouts.header')
<section class="bg-yellow-100 text-yellow-900 min-h-screen flex items-center justify-center text-center relative">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl md:text-6xl font-bold mb-6">
            Selamat Datang, {{ Auth::user()->name }}
        </h2>
        <p class="mb-10 text-2xl md:text-3xl">
            Temukan buku favoritmu dan mulai membaca sekarang juga.
        </p>
        <a href="#book-section" class="bg-yellow-700 text-white text-lg md:text-xl font-semibold px-8 py-4 rounded-full shadow hover:bg-yellow-800 transition">
            Lihat Buku
        </a>
    </div>
</section>


    <section id="book-section" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Daftar Buku</h2>

            <!-- Container untuk render buku -->
            <div id="booksGrid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Buku akan muncul di sini dari JS -->
            </div>
        </div>
    </section>

    <script>
        async function fetchBooks() {
            try {
                // Ganti URL ini sesuai endpoint API-mu yang mengembalikan data JSON buku
                const response = await fetch('/api/books');
                if (!response.ok) throw new Error('Gagal mengambil data buku');

                const books = await response.json();

            const container = document.getElementById('booksGrid');
container.className = 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center';

books.forEach(book => {
    const bookCard = document.createElement('div');
    bookCard.className = 'bg-white rounded-lg shadow-lg flex flex-col'; // shadow static, no hover scale
    bookCard.style.width = '200px';  // Lebar fix
    bookCard.style.height = '280px'; // Tinggi fix

    // Cek apakah judul terlalu panjang untuk tooltip
    const safeTitle = book.name || '';
    const tooltipTitle = safeTitle.length > 25 ? safeTitle : '';

    bookCard.innerHTML = `
        <img src="${book.cover ? '/storage/' + book.cover : 'https://via.placeholder.com/150'}"
             alt="${safeTitle}"
             style="height: 140px; width: 100%; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;" />
        <div class="flex-1 flex flex-col px-2 py-2">
            <h3 class="text-base font-semibold mb-1 text-center truncate" title="${book.name}">
    ${book.name}
</h3>

            <p class="text-xs text-gray-600 mb-1">Penulis: ${book.author}</p>
            <p class="text-xs text-gray-600 mb-2">Tahun: ${book.year}</p>
            <div class="mt-auto">
                <a href="/user/book/${book.id}"
                   class="block text-xs bg-blue-500 text-white py-1.5 rounded hover:bg-blue-600 transition text-center">
                   Lihat Detail
                </a>
            </div>
        </div>
    `;

    container.appendChild(bookCard);
});




            } catch (error) {
                console.error(error);
                alert('Gagal memuat data buku. Coba refresh halaman.');
            }
        }

        // Panggil fungsi fetchBooks saat halaman sudah siap
        document.addEventListener('DOMContentLoaded', fetchBooks);
    </script>

</body>
</html>
