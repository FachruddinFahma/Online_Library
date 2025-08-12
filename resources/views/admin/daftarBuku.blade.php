@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<style>
  .dataTables_filter {
    margin-bottom: 1rem;
  }
</style>

<div class="overflow-x-auto mt-6">
 <table id="bookTable" class="table-auto min-w-full border border-gray-300 text-sm">
  <thead class="bg-gray-200 text-xs">
    <tr>
      <th class="px-2 py-2">ID</th>
      <th class="px-2 py-2">Sampul</th>
      <th class="px-2 py-2">Judul</th>
      <th class="px-2 py-2">Penulis</th>
      <th class="px-2 py-2">Tahun</th>
      <th class="px-2 py-2">Penerbit</th>
      <th class="px-2 py-2">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($books as $book)
    <tr class="border-t text-xs" data-id="{{ $book->id }}">
      <td class="px-2 py-2">{{ $book->id }}</td>
      <td class="px-2 py-2">
        @if($book->cover)
          <img src="{{ asset('storage/' . $book->cover) }}" alt="Sampul" class="w-12 h-16 object-cover">
        @else
          <span class="text-gray-400 italic">Tidak ada</span>
        @endif
      </td>
      <td class="px-2 py-2 book-name">{{ $book->name }}</td>
      <td class="px-2 py-2 book-author">{{ $book->author }}</td>
      <td class="px-2 py-2 book-year">{{ $book->year }}</td>
      <td class="px-2 py-2 book-publisher">{{ $book->publisher }}</td>
      <td class="px-2 py-2 space-x-1">

        <a href="#"
           class="edit-btn bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded shadow"
           data-id="{{ $book->id }}"
           data-name="{{ $book->name }}"
           data-author="{{ $book->author }}"
           data-year="{{ $book->year }}"
           data-publisher="{{ $book->publisher }}"
           data-genre="{{ $book->genre }}"
           data-page-count="{{ $book->pageCount }}"
           data-summary="{{ $book->summary }}">
           ✏️ Edit
        </a>

       <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline delete-form">

            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded shadow">
                🗑️ Hapus
            </button>
        </form>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
  <div class="relative bg-white w-full max-w-5xl mx-auto my-10 p-6 rounded-lg shadow-lg">
    <button id="closeEditModal" type="button" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl font-bold z-10">
      &times;
    </button>
    <h2 class="text-3xl font-bold mb-6 text-center">Edit Buku</h2>
    <form id="editBookForm" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="editId">

      <div class="space-y-4">
        <div>
          <label for="editName" class="block font-semibold">Nama Buku</label>
          <input type="text" name="name" id="editName" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editYear" class="block font-semibold">Tahun</label>
          <input type="number" name="year" id="editYear" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editAuthor" class="block font-semibold">Penulis</label>
          <input type="text" name="author" id="editAuthor" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editPublisher" class="block font-semibold">Penerbit</label>
          <input type="text" name="publisher" id="editPublisher" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editPageCount" class="block font-semibold">Jumlah Halaman</label>
          <input type="number" name="pageCount" id="editPageCount" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editGenre" class="block font-semibold">Genre</label>
          <input type="text" name="genre" id="editGenre" class="w-full border p-3 rounded" required>
        </div>

        <div>
          <label for="editSummary" class="block font-semibold">Ringkasan</label>
          <textarea name="summary" id="editSummary" class="w-full border p-3 rounded" rows="4" required></textarea>
        </div>

        <div>
          <label for="editCover" class="block font-semibold">Ganti Sampul (opsional)</label>
          <input type="file" name="cover" id="editCover" class="w-full border p-3 rounded">
        </div>
      </div>

      <div class="mt-6 text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function () {
  $('#bookTable').DataTable({
      paging: false,
      info: false,
      searching: true,
      order: [[0, 'asc']]
  });

  $('.edit-btn').on('click', function (e) {
    e.preventDefault();

    const el = $(this);
    $('#editBookForm').attr('action', `/admin/books/${el.data('id')}`);
    $('#editId').val(el.data('id'));
    $('#editName').val(el.data('name'));
    $('#editAuthor').val(el.data('author'));
    $('#editYear').val(el.data('year'));
    $('#editPublisher').val(el.data('publisher'));
    $('#editGenre').val(el.data('genre'));
    $('#editPageCount').val(el.data('page-count'));
    $('#editSummary').val(el.data('summary'));

    $('#editModal').fadeIn();
  });

  $('#closeEditModal').on('click', function () {
    $('#editModal').fadeOut();
  });

  $('#editModal').on('click', function(e) {
    if ($(e.target).is('#editModal')) {
      $(this).fadeOut();
    }
  });

  // Submit edit form pakai fetch API
  $('#editBookForm').on('submit', async function(e) {
    e.preventDefault();

    const form = this;
    const url = $(form).attr('action');
    const formData = new FormData(form);

    // Tambah _method PUT agar Laravel mengerti
    formData.append('_method', 'PUT');

    // CSRF token
    const token = $('meta[name="csrf-token"]').attr('content');

    try {
      const response = await fetch(url, {
        method: 'POST', // POST + _method=PUT
        headers: {
          'X-CSRF-TOKEN': token,
          'Accept': 'application/json'
        },
        body: formData
      });

      if (!response.ok) {
        if (response.status === 422) {
          const errors = await response.json();
          alert(Object.values(errors).flat().join('\n'));
        } else {
          alert('Terjadi kesalahan saat update buku.');
        }
        return;
      }

      const data = await response.json();

      alert('Buku berhasil diupdate!');

      // Update row di tabel
      const book = data.data || data;

      const row = $(`#bookTable tbody tr[data-id='${book.id}']`);

      // Update teks di tabel
      row.find('.book-name').text(book.name);
      row.find('.book-author').text(book.author);
      row.find('.book-year').text(book.year);
      row.find('.book-publisher').text(book.publisher);

      // Update tombol edit data-attributes supaya data terbaru juga di tombolnya
      const editBtn = row.find('.edit-btn');
      editBtn.data('name', book.name);
      editBtn.data('author', book.author);
      editBtn.data('year', book.year);
      editBtn.data('publisher', book.publisher);
      editBtn.data('genre', book.genre);
      editBtn.data('page-count', book.pageCount);
      editBtn.data('summary', book.summary);

      // Update cover gambar di tabel kalau ada
      if (book.cover) {
        const imgTd = row.find('td').eq(1); // kolom ke-2 tempat cover
        const imgTag = imgTd.find('img');

        if (imgTag.length) {
          // Update src dengan cache buster supaya browser tidak pakai cache lama
          imgTag.attr('src', `/storage/${book.cover}?t=${new Date().getTime()}`);
        } else {
          // Jika sebelumnya tidak ada gambar, tambahkan img tag
          imgTd.html(`<img src="/storage/${book.cover}?t=${new Date().getTime()}" alt="Sampul" class="w-12 h-16 object-cover">`);
        }
      }

      $('#editModal').fadeOut();

    } catch (error) {
      console.error(error);
      alert('Gagal mengirim data. Cek koneksi internet.');
    }
  });

$(document).on('submit', '.delete-form', function(e) {
  e.preventDefault();

  if (!confirm('Yakin mau hapus buku ini?')) return;

  const form = this;
  const url = $(form).attr('action');
  const token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: url,
    type: 'POST', // karena pakai method spoofing
    data: {
      _method: 'DELETE',
      _token: token
    },
    success: function(response) {
      alert('Buku berhasil dihapus!');
      $(form).closest('tr').fadeOut(300, function() {
        $(this).remove();
      });
    },
    error: function(xhr) {
      if (xhr.status === 422) {
        const errors = xhr.responseJSON;
        alert(Object.values(errors).flat().join('\n'));
      } else if(xhr.status === 419) {
        alert('Session sudah habis, silakan refresh halaman.');
      } else {
        alert('Gagal menghapus buku.');
      }
    }
  });
});

});
</script>
@endsection


