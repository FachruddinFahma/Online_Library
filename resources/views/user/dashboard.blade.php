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
        /* Tooltip custom */
        #tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            pointer-events: none;
            z-index: 50;
            display: none;
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

@include('layouts.header')

<section class="bg-yellow-100 text-yellow-900 relative" style="height: 600px;">
    <div class="container mx-auto px-4 h-full flex items-center justify-center text-center">
        <div>
            <h2 class="text-5xl md:text-6xl font-bold mb-6">
                Selamat Datang, {{ Auth::user()->name }}
            </h2>
            <p class="mb-10 text-2xl md:text-3xl">
                Temukan buku favoritmu dan mulai membaca sekarang juga.
            </p>
            <a href="#book-section" id="scrollToBooks" class="bg-yellow-700 text-white text-lg md:text-xl font-semibold px-8 py-4 rounded-full shadow hover:bg-yellow-800 transition">
                Lihat Buku
            </a>
        </div>
    </div>
</section>

<section id="book-section" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Daftar Buku</h2>

        <div id="booksGrid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Buku akan muncul di sini dari JS -->
        </div>
    </div>
</section>

<!-- Tooltip -->
<div id="tooltip"></div>

<script>
    // Scroll tombol Lihat Buku dengan offset header
    document.getElementById('scrollToBooks').addEventListener('click', function(e) {
        e.preventDefault(); // cegah default anchor
        const headerHeight = document.querySelector('header').offsetHeight; // tinggi header sticky
        const target = document.querySelector('#book-section');
        const targetPosition = target.offsetTop - headerHeight; // offset supaya berhenti pas di bawah header
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    });

    async function fetchBooks() {
        try {
            const response = await fetch('/api/books');
            if (!response.ok) throw new Error('Gagal mengambil data buku');

            const books = await response.json();

            const container = document.getElementById('booksGrid');
            container.className = 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 justify-items-center';

            books.forEach(book => {
                const bookCard = document.createElement('div');
                bookCard.className = 'bg-white rounded-lg shadow-lg flex flex-col';
                bookCard.style.width = '200px';
                bookCard.style.height = '280px';

                const safeTitle = book.name || '';

                bookCard.innerHTML = `
                    <img src="${book.cover ? '/storage/' + book.cover : 'https://via.placeholder.com/150'}"
                         alt="${safeTitle}"
                         style="height: 140px; width: 100%; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;" />
                    <div class="flex-1 flex flex-col px-2 py-2">
                        <h3 class="text-base font-semibold mb-1 text-center truncate">
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

                // Tooltip hover untuk seluruh card
                bookCard.addEventListener('mouseenter', e => {
                    const tooltip = document.getElementById('tooltip');
                    tooltip.innerText = safeTitle;
                    tooltip.style.display = 'block';
                });

                bookCard.addEventListener('mousemove', e => {
                    const tooltip = document.getElementById('tooltip');
                    tooltip.style.left = (e.pageX + 10) + 'px';
                    tooltip.style.top = (e.pageY + 10) + 'px';
                });

                bookCard.addEventListener('mouseleave', e => {
                    const tooltip = document.getElementById('tooltip');
                    tooltip.style.display = 'none';
                });

                container.appendChild(bookCard);
            });

        } catch (error) {
            console.error(error);
            alert('Gagal memuat data buku. Coba refresh halaman.');
        }
    }

    document.addEventListener('DOMContentLoaded', fetchBooks);
</script>

</body>
</html>
