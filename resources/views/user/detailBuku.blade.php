<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <title>Detail Buku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="user-id" content="{{ auth()->id() }}" /> <!-- User login ID -->
    <style>
        /* Minimal styling untuk dropdown menu */
        .comment-menu {
            min-width: 100px;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300 min-h-screen font-sans">

@include('layouts.header')

<div class="container mx-auto px-4 mt-8 mb-8">
    <!-- Detail Buku -->
    <div id="bookDetail" class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden transform hover:scale-[1.01] transition duration-300">
        <div class="p-6 text-center text-gray-500">Memuat data buku...</div>
    </div>

    <!-- Komentar -->
    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl mt-6 p-6">
        <h3 class="text-xl font-semibold mb-4 text-yellow-500">Komentar</h3>
        <div id="commentsList" class="space-y-4 mb-6">
            <p class="text-gray-500 italic">Memuat komentar...</p>
        </div>

        <form id="commentForm" class="space-y-4">
            <textarea id="commentText" class="w-full p-3 border rounded-lg dark:bg-gray-700 dark:border-gray-600" placeholder="Tulis komentar..."></textarea>
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg">Kirim</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const bookId = window.location.pathname.split("/").pop();
    const bookDetail = document.getElementById("bookDetail");
    const commentsList = document.getElementById("commentsList");
    const commentForm = document.getElementById("commentForm");
    const commentText = document.getElementById("commentText");
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const loggedInUserId = document.head.querySelector('meta[name="user-id"]').content; // ambil ID user login

    let parentId = null;

    // Render satu komentar
    function renderCommentDiv(comment, indent = false) {
        const canDelete = comment.user?.id == loggedInUserId; // hanya user pemilik komentar
        return `
        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg relative ${indent ? 'ml-10' : ''}">
            <p class="text-gray-800 dark:text-gray-200">${comment.isi_komentar}</p>
            <p class="text-sm text-gray-500 mt-1">
                Oleh: ${comment.user?.name ?? 'Anonim'} • ${new Date(comment.created_at).toLocaleString()}
            </p>
            <button class="more-btn absolute top-2 right-2 bg-yellow-500 text-white font-bold w-6 h-6 flex items-center justify-center rounded-full text-lg shadow" data-id="${comment.id}">⋮</button>

            <div class="comment-menu hidden absolute top-6 right-2 bg-white dark:bg-gray-800 border rounded shadow-md z-10">
                <button class="comment-reply block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left" data-id="${comment.id}" data-username="${comment.user?.name ?? 'Anonim'}">Balas</button>
                ${canDelete ? `<button class="comment-delete block px-4 py-2 hover:bg-red-100 dark:hover:bg-red-700 w-full text-left text-red-600" data-id="${comment.id}">Hapus</button>` : ''}
            </div>
        </div>`;
    }

    // Render komentar recursive
    function renderCommentsRecursive(comments, indent = false) {
        let html = '';
        comments.forEach(comment => {
            html += renderCommentDiv(comment, indent);
            if (comment.children_recursive && comment.children_recursive.length > 0) {
                html += renderCommentsRecursive(comment.children_recursive, true);
            }
        });
        return html;
    }

    // Load detail buku
    async function loadBook() {
        try {
            const res = await fetch(`/api/books/${bookId}`);
            if (!res.ok) throw new Error('Gagal mengambil data buku');
            const book = await res.json();

            bookDetail.innerHTML = `
                <div class="w-full overflow-hidden rounded-t-3xl bg-black" style="height: 600px;">
                    ${book.cover
                        ? `<img src="/storage/${book.cover}" alt="Cover Buku" class="w-full h-full object-cover object-center" />`
                        : `<div class="flex items-center justify-center h-full"><p class="text-white text-lg italic">Tidak ada cover</p></div>`}
                </div>
                <div class="p-6 md:p-8">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4 text-red-500">${book.name}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 text-base md:text-lg">
                        <p><span class="font-semibold">Penulis:</span> ${book.author}</p>
                        <p><span class="font-semibold">Tahun Terbit:</span> ${book.year}</p>
                        <p><span class="font-semibold">Penerbit:</span> ${book.publisher}</p>
                        <p><span class="font-semibold">Genre:</span> ${book.genre}</p>
                        <p><span class="font-semibold">Jumlah Halaman:</span> ${book.pageCount}</p>
                    </div>
                    ${book.summary
                        ? `<div class="mt-6">
                            <h3 class="text-xl font-semibold mb-2 text-yellow-500">Mulai Baca:</h3>
                            <p class="text-justify text-base text-gray-800 dark:text-gray-300">${book.summary}</p>
                        </div>` : ''}
                </div>
            `;
        } catch (error) {
            bookDetail.innerHTML = `<div class="p-6 text-red-500">Gagal memuat data buku</div>`;
            console.error(error);
        }
    }

    // Load komentar
    async function loadComments() {
        try {
            const res = await fetch(`/books/${bookId}/comments`, { credentials: 'same-origin' });
            if (!res.ok) throw new Error('Gagal mengambil komentar');

            const comments = await res.json();
            if (!comments.length) {
                commentsList.innerHTML = `<p class="text-gray-500 italic">Belum ada komentar.</p>`;
                return;
            }

            commentsList.innerHTML = renderCommentsRecursive(comments);
        } catch (error) {
            commentsList.innerHTML = `<p class="text-red-500">Gagal memuat komentar.</p>`;
            console.error(error);
        }
    }

    // Submit komentar
    commentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!commentText.value.trim()) return;

        try {
            const res = await fetch(`/books/${bookId}/comments`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    isi_komentar: commentText.value,
                    parent_id: parentId,
                }),
            });

            if (!res.ok) throw new Error('Gagal mengirim komentar');

            commentText.value = '';
            parentId = null;
            loadComments();
        } catch {
            alert('Komentar gagal dikirim!');
        }
    });

    // Event delegation tombol balas/hapus
    document.addEventListener('click', (e) => {
        if (e.target.matches('.more-btn')) {
            const menu = e.target.nextElementSibling;
            document.querySelectorAll('.comment-menu').forEach(m => m.classList.add('hidden'));
            menu.classList.toggle('hidden');
            return;
        }

        if (!e.target.closest('.comment-menu') && !e.target.matches('.more-btn')) {
            document.querySelectorAll('.comment-menu').forEach(m => m.classList.add('hidden'));
        }

        if (e.target.matches('.comment-delete')) {
            const id = e.target.dataset.id;
            if (confirm('Yakin mau hapus komentar ini?')) {
                fetch(`/komentar/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    credentials: 'same-origin',
                })
                .then(res => { if(!res.ok) throw new Error(); return res.json(); })
                .then(() => { alert('Komentar berhasil dihapus'); loadComments(); })
                .catch(() => alert('Gagal hapus komentar'));
            }
        }

        if (e.target.matches('.comment-reply')) {
            const username = e.target.dataset.username;
            parentId = e.target.dataset.id;
            commentText.focus();
            commentText.value = `@${username} `;
            e.target.closest('.comment-menu').classList.add('hidden');
        }
    });

    // Jalankan
    loadBook();
    loadComments();
});
</script>

</body>
</html>
