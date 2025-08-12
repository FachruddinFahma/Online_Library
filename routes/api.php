    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\API\BookApiController;

    Route::get('books', [BookApiController::class, 'index']);
    Route::get('books/{id}', [BookApiController::class, 'show']);
    Route::post('books', [BookApiController::class, 'store']);
    Route::put('books/{id}', [BookApiController::class, 'update']);
    Route::delete('books/{id}', [BookApiController::class, 'destroy']);
