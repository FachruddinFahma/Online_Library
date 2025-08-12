<?php

    namespace App\Http\Controllers\API;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Book;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Storage;

    class BookApiController extends Controller
    {
        public function index()
        {
            return response()->json(Book::all(), 200);
        }

        public function store(Request $request)
        {
            // Validasi data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'year' => 'required|integer',
                'author' => 'required|string|max:255',
                'publisher' => 'required|string|max:255',
                'pageCount' => 'required|integer',
                'genre' => 'required|string|max:100',
                'summary' => 'nullable|string',
                'cover' => 'nullable|file|image|max:2048', // max 2MB
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Simpan cover jika ada
            $coverPath = null;
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('covers', 'public');
            }

            // Simpan buku
            $book = Book::create([
                'name' => $request->name,
                'year' => $request->year,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'pageCount' => $request->pageCount,
                'genre' => $request->genre,
                'summary' => $request->summary,
                'cover' => $coverPath,
            ]);

            return response()->json($book, 201);
        }

        public function show($id)
        {
            $book = Book::find($id);
            if (!$book) return response()->json(['message' => 'Not Found'], 404);
            return response()->json($book);
        }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) return response()->json(['message' => 'Not Found'], 404);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer',
            'author' => 'sometimes|required|string|max:255',
            'publisher' => 'sometimes|required|string|max:255',
            'pageCount' => 'sometimes|required|integer',
            'genre' => 'sometimes|required|string|max:100',
            'summary' => 'nullable|string',
            'cover' => 'nullable|file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil semua data kecuali cover
        $data = $request->except('cover');

        // Kalau ada cover baru
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Update buku
        $book->update($data);

        return response()->json([
            'message' => 'Buku berhasil diupdate',
            'data' => $book
        ]);
    }


        public function destroy($id)
        {
            $book = Book::find($id);
            if (!$book) return response()->json(['message' => 'Not Found'], 404);

            // Hapus cover juga kalau ada
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $book->delete();
            return response()->json(['message' => 'Deleted']);
        }
    }
