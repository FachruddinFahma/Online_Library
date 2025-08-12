<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    
    public function index(): View
    {
        $books = Book::all();
        return view('user.dashboard', compact('books'));
    }


    public function show(int $id): View
    {
        $book = Book::findOrFail($id);
        return view('user.detailBuku', compact('book'));
    }
}
