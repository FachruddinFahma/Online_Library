<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <title>Detail Buku - {{ $book->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300 min-h-screen font-sans">

    @include('layouts.header')

    <div class="container mx-auto px-4 mt-8 mb-8">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-3xl overflow-hidden transform hover:scale-[1.01] transition duration-300">

            {{-- Gambar cover --}}
            <div class="w-full overflow-hidden rounded-t-3xl bg-black" style="height: 600px;">
                @if($book->cover)
                    <img
                        src="{{ asset('storage/' . $book->cover) }}"
                        alt="Cover Buku"
                        class="w-full h-full object-cover object-center"
                    />
                @else
                    <div class="flex items-center justify-center h-full">
                        <p class="text-white text-lg italic">Tidak ada cover</p>
                    </div>
                @endif
            </div>

            {{-- Detail buku --}}
            <div class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 text-red-500 leading-snug">
                    {{ $book->name }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 text-base md:text-lg">
                    <p><span class="font-semibold">Penulis:</span> {{ $book->author }}</p>
                    <p><span class="font-semibold">Tahun Terbit:</span> {{ $book->year }}</p>
                    <p><span class="font-semibold">Penerbit:</span> {{ $book->publisher }}</p>
                    <p><span class="font-semibold">Genre:</span> {{ $book->genre }}</p>
                    <p><span class="font-semibold">Jumlah Halaman:</span> {{ $book->pageCount }}</p>
                </div>

                @if($book->summary)
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2 text-yellow-500">Mulai Baca:</h3>
                        <p class="text-justify text-base text-gray-800 dark:text-gray-300 leading-relaxed tracking-wide">
                            {{ $book->summary }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
