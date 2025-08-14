<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                "name" => "Malin Kundang Menjadi Batu Kristal",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/irjj4fGdYUf6BLFODVRzGWoR1AjIi7C7a0GIx3pS.jpg",
                "summary" => "aku adalah jagoan neon",
            ],
            [
                "name" => "Ambang Batas",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/hx4Pcdc5v39CAetVdUu7RSEr9pO2JIvaamZ9Q1pE.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Desa Mistery Gwichonri",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/9XZBrOy7KSsT10SGWRIsv2OpJinyi3xsYSwo6Zxg.jpg",
                "summary" => "Petualangan mistery",
            ],
            [
                "name" => "Batas Cakrawla",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/Ho87xWTjz4nmQeUteKGfj4Eq5P0TgxYhCzOqFrxI.jpg",
                "summary" => "Cakrawala dunia antah berantah",
            ],
            [
                "name" => "Jotosono & Jotosini",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/N8TBYnOtXjJ3KBRC4Ll6d4GVits5V3UfSFBX7CsZ.jpg",
                "summary" => "Duo kucing maut",
            ],
            [
                "name" => "Sinchan-Kun",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/dRz5DlxkOLckjK4ZAs8ZP6adiNdPczGzv8iR0pBu.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Violet Evergarden",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/M93U2tLpncdRhvPFYEYEDmjKSsunU4q1r8hdqAfw.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Black Cat Mystic",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/Eg0pq2Fso3JTwdCBIRWoK0c4EdB8tllJqG58zkT8.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Zootopia",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/UiiRc022841dfXc3AdDiFM0M27KRzKOYlq8Xl4YP.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Camping Ground In Another World",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/cJBcU8QnQoSxh98kgSAYuwkXX5wDU3NOiomdt8dL.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
            [
                "name" => "Sunset in Japan",
                "year" => "2013",
                "author" => "Penulis Update",
                "publisher" => "Fahma Company",
                "pageCount" => 300,
                "genre" => "Sci-fi",
                "cover" => "covers/eWHQGkzmDeoHVAwPakk4IVdLuLMwZ0jRTSpPtlqS.jpg",
                "summary" => "DIkala senja kenapa hayoo awokaokwoak",
            ],
        ];

        DB::table('books')->insert($books);
    }
}
