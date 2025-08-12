<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            primary: '#f97316'
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen px-4">

  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 relative">

    <a href="{{ url('/') }}" class="absolute top-4 left-4 text-2xl font-bold text-orange-500 hover:text-orange-600">
      &lt;
    </a>

    <div class="text-center mb-6">
      <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" class="w-8 h-8 mx-auto mb-2" alt="Logo">
      <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Buat Akun</h1>
      <p class="text-sm text-gray-500 dark:text-gray-400">Isi formulir untuk mendaftar</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
      @csrf

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
               class="w-full p-2.5 border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white
               focus:outline-none focus:ring-2 focus:ring-primary
               @error('name') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror" required>
        @error('name')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
               class="w-full p-2.5 border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white
               focus:outline-none focus:ring-2 focus:ring-primary
               @error('email') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror" required>
        @error('email')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
        <input type="password" name="password" id="password"
               class="w-full p-2.5 border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white
               focus:outline-none focus:ring-2 focus:ring-primary
               @error('password') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror" required>
        @error('password')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="w-full p-2.5 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white
               focus:outline-none focus:ring-2 focus:ring-primary" required>
      </div>

      <div>
        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Daftar Sebagai</label>
        <select name="role" id="role"
                class="w-full p-2.5 border rounded-md bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white
                focus:outline-none focus:ring-2 focus:ring-primary
                @error('role') border-red-500 @else border-gray-300 dark:border-gray-600 @enderror" required>
          <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
          <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
          <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
          <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <button type="submit"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 rounded-md transition duration-200">
          Daftar
        </button>
      </div>

      <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-2">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-orange-500 hover:underline">Login di sini</a>
      </p>
    </form>
  </div>

</body>
</html>
