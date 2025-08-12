@extends('layouts.app')

@section('content')
<form id="addBookForm" enctype="multipart/form-data"
  class="w-full bg-white rounded-none shadow-none border-t border-gray-200 px-6 py-8 mt-2">
  @csrf

  <h2 class="text-3xl font-bold mb-6 text-gray-800 tracking-wide">📚 Tambah Buku Baru</h2>

  <div id="errorMessages" class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded hidden">
    <strong>Terjadi kesalahan:</strong>
    <ul class="mt-2 list-disc list-inside"></ul>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>
      <label for="cover" class="block mb-2 text-lg font-medium text-gray-700">Gambar Sampul Buku</label>
      <input type="file" name="cover" id="cover" accept="image/*"
        class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
    </div>

    <div>
      <label for="name" class="block mb-2 text-lg font-medium text-gray-700">Judul Buku</label>
      <input type="text" name="name" id="name"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>

    <div>
      <label for="author" class="block mb-2 text-lg font-medium text-gray-700">Penulis</label>
      <input type="text" name="author" id="author"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>

    <div>
      <label for="year" class="block mb-2 text-lg font-medium text-gray-700">Tahun Terbit</label>
      <input type="number" name="year" id="year" min="1000" max="9999"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>

    <div>
      <label for="publisher" class="block mb-2 text-lg font-medium text-gray-700">Penerbit</label>
      <input type="text" name="publisher" id="publisher"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>

    <div>
      <label for="pageCount" class="block mb-2 text-lg font-medium text-gray-700">Jumlah Halaman</label>
      <input type="number" name="pageCount" id="pageCount" min="1"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>

    <div>
      <label for="genre" class="block mb-2 text-lg font-medium text-gray-700">Genre</label>
      <input type="text" name="genre" id="genre"
        class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        required>
    </div>
  </div>

  <div class="mt-6">
    <label for="summary" class="block mb-2 text-lg font-medium text-gray-700">Ringkasan (opsional)</label>
    <textarea name="summary" id="summary" rows="4"
      class="w-full border border-gray-300 rounded-lg py-3 px-4 text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none"></textarea>
  </div>

  <div class="text-right mt-8">
    <button id="submitBtn" type="submit"
      class="bg-blue-700 hover:bg-blue-800 text-white text-lg font-semibold px-10 py-3 rounded-lg transition duration-200">
      Simpan Buku
    </button>
  </div>
</form>

<script>
  document.getElementById('addBookForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const errorBox = document.getElementById('errorMessages');
    const errorList = errorBox.querySelector('ul');
    errorList.innerHTML = '';
    errorBox.classList.add('hidden');

    const formData = new FormData(form);

    try {
      const res = await fetch('{{ route('admin.books.store') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          // Note: jangan set 'Content-Type' kalau pakai FormData,
          // biarkan browser yang set otomatis dengan boundary multipart/form-data
        },
        body: formData,
      });

      if (!res.ok) {
        if (res.status === 422) {
          // Validasi error
          const data = await res.json();
          for (const key in data) {
            const msgs = data[key];
            msgs.forEach(msg => {
              const li = document.createElement('li');
              li.textContent = msg;
              errorList.appendChild(li);
            });
          }
          errorBox.classList.remove('hidden');
        } else {
          alert('Terjadi kesalahan server. Coba lagi nanti.');
        }
        return;
      }

      // Kalau berhasil
      alert('Buku berhasil ditambahkan!');
      form.reset();

      // Opsional: kamu bisa redirect atau reload page
      // window.location.href = '{{ route("admin.books.index") }}';

    } catch (err) {
      console.error(err);
      alert('Gagal mengirim data. Cek koneksi internet.');
    }
  });
</script>
@endsection
