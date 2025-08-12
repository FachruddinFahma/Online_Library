<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin
     */
    public function index()
    {

        $books = Book::all();

        return view('admin.dashboard', compact('books'));
    }
}
