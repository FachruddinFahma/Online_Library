<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    // Ambil semua komentar buku (nested)
    public function index($book_id)
    {
        $komentar = Komentar::with(['user', 'childrenRecursive'])
            ->where('book_id', $book_id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($komentar);
    }

    // Tambah komentar atau reply
    public function store(Request $request, $book_id)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'User belum login'], 401);
        }

        $validated = $request->validate([
            'isi_komentar' => 'required|string|max:500',
            'parent_id' => 'nullable|exists:komentar,id',
        ]);

        $komentar = Komentar::create([
            'user_id' => auth()->id(),
            'book_id' => $book_id,
            'isi_komentar' => $validated['isi_komentar'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $komentar->load('user')
        ], 201);
    }

    // Hapus komentar
   public function destroy($id)
{
    $komentar = Komentar::findOrFail($id);

    // Cek apakah user login adalah pemilik komentar
    if ($komentar->user_id !== auth()->id()) {
        return response()->json(['message' => 'Tidak diizinkan'], 403);
    }

    $komentar->delete(); // hapus komentar & anaknya

    return response()->json([
        'message' => 'Komentar berhasil dihapus'
    ]);
}

}
