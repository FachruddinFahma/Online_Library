<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Laravel App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-lg bg-white rounded-xl shadow-lg dark:bg-gray-800 p-8 relative">

        <a href="/" class="absolute top-6 left-6 text-3xl font-bold text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition duration-300">
            &lt;
        </a>

        <div class="text-center mb-6 mt-4">
            <a href="{{ url('/') }}" class="absolute top-6 left-6 text-3xl font-bold text-orange-500 hover:text-orange-600">&lt;</a>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">Selamat Datang</h2>
        </div>


        @if (session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <button type="submit"
                        class="w-full py-2 px-4 bg-orange-600 hover:bg-orange-500 text-white font-semibold rounded-lg transition duration-200">
                    Login
                </button>
            </div>

            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                Belum punya akun? <a href="{{ route('register') }}" class="text-orange-600 hover:underline">Daftar</a>
            </div>
        </form>

    </div>

</body>
</html>
