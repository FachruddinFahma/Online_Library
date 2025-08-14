    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\API\BookApiController;
    use App\Http\Controllers\API\KomentarController;

    Route::get('books', [BookApiController::class, 'index']);
    Route::get('books/{id}', [BookApiController::class, 'show']);
    Route::post('books', [BookApiController::class, 'store']);
    Route::put('books/{id}', [BookApiController::class, 'update']);
    Route::delete('books/{id}', [BookApiController::class, 'destroy']);
    Route::post('books/mass-destroy', [BookApiController::class, 'massDestroy']);

    // Route::get('/books/{book_id}/comments', [KomentarController::class, 'index']);
    // Route::post('/books/{book_id}/comments', [KomentarController::class, 'store']);
    // Route::delete('/komentar/{id}', [KomentarController::class, 'destroy']);
