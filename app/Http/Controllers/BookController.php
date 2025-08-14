<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{





   public function index()
{
    $books = Book::all();
    return view('admin.daftarBuku', compact('books'));
}





    // ✅ SIMPAN BUKU BARU
  public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'year' => 'required|digits:4|integer',
        'author' => 'required|string',
        'summary' => 'nullable|string',
        'publisher' => 'required|string',
        'pageCount' => 'required|integer|min:1',
        'genre' => 'required|string',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:10248',
    ]);

    // Simpan file cover (jika ada)
    if ($request->hasFile('cover')) {
        $validated['cover'] = $request->file('cover')->store('covers', 'public');
    }

    // Simpan ke database
    Book::create($validated);

    return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
}

    // ✅ TAMPILKAN 1 BUKU (jika pakai JSON / modal)
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // ✅ UPDATE DATA BUKU
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'author' => 'required|string',
        'year' => 'required|digits:4|integer',
        'publisher' => 'required|string',
        'genre' => 'required|string',
        'pageCount' => 'required|integer',
        'summary' => 'nullable|string',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:10248',
    ]);

    $book = Book::findOrFail($id);

    $book->name = $request->input('name');
    $book->author = $request->input('author');
    $book->year = $request->input('year');
    $book->publisher = $request->input('publisher');
    $book->genre = $request->input('genre');
    $book->pageCount = $request->input('pageCount');
    $book->summary = $request->input('summary');

    if ($request->hasFile('cover')) {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $coverPath = $request->file('cover')->store('covers', 'public');
        $book->cover = $coverPath;
    }

    $book->save();

    return response()->json([
        'message' => 'Buku berhasil diupdate!',
        'data' => $book
    ]);
}


public function edit($id)
{
    $book = Book::findOrFail($id);
    return response()->json($book);
}



 public function destroy($id)
{
    $book = Book::findOrFail($id);

    if ($book->cover) {
        Storage::disk('public')->delete($book->cover);
    }

    $book->delete();

    return response()->json(['message' => 'Buku berhasil dihapus'], 200);
}


public function massDestroy(Request $request)
{
    $ids = $request->input('ids', []);
    if (!empty($ids)) {
        Book::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Buku terpilih berhasil dihapus']);
    }
    return response()->json(['message' => 'Tidak ada buku yang dihapus'], 400);
}

}
