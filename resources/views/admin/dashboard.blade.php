@extends('layouts.app')

@section('content')
<div id="booksContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
  <!-- Data buku akan di-inject lewat JS -->
</div>

<script>
  async function fetchBooks() {
    try {
      const res = await fetch('/api/books');
      const books = await res.json();

      const container = document.getElementById('booksContainer');
      if (books.length === 0) {
        container.innerHTML = `<div class="col-span-full text-center text-gray-500">Tidak ada buku ditemukan.</div>`;
        return;
      }

      container.innerHTML = books.map(book => `
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img
            src="${book.cover ? `/storage/${book.cover}` : 'https://via.placeholder.com/400x200?text=No+Image'}"
            alt="Cover ${book.name}"
            class="w-full h-48 object-cover">

          <div class="p-4">
            <h2 class="text-lg font-semibold">${escapeHtml(book.name)}</h2>
            <p class="text-gray-600 text-sm mb-2">Penulis: ${escapeHtml(book.author)}</p>
            <div class="text-sm text-gray-500">
              <p><strong>Tahun:</strong> ${escapeHtml(book.year)}</p>
              <p><strong>Genre:</strong> ${escapeHtml(book.genre)}</p>
            </div>
          </div>
        </div>
      `).join('');
    } catch (err) {
      console.error(err);
      document.getElementById('booksContainer').innerHTML = `<div class="col-span-full text-center text-red-500">Gagal memuat data buku.</div>`;
    }
  }

  function escapeHtml(text) {
    return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  fetchBooks();
</script>
@endsection
