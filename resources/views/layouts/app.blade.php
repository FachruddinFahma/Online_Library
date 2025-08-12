<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://cdn.tailwindcss.com"></script>

  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            softcream: '#fae8b4',
            redhover: '#fee2e2',
            active: '#f59e0b'
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 text-lg">


  <aside class="w-64 h-screen fixed top-0 left-0 bg-softcream text-gray-800 p-6 shadow-xl z-40 rounded-r-3xl border-r border-gray-200">
    <h2 class="text-2xl font-bold mb-8 tracking-wide">📚 Menu</h2>

    <nav>
      <ul class="space-y-2">
        <li>
          <a href="{{ route('admin.dashboard') }}"
            class="block w-full px-5 py-3 rounded-xl transition font-semibold
              {{ request()->routeIs('admin.dashboard') ? 'bg-white shadow-md text-active' : 'hover:bg-white hover:text-active' }}">
            🏠 Dashboard
          </a>
        </li>

        <li>
          <a href="{{ route('admin.books.create') }}"
            class="block w-full px-5 py-3 rounded-xl transition font-semibold
              {{ request()->routeIs('admin.books.create') ? 'bg-white shadow-md text-active' : 'hover:bg-white hover:text-active' }}">
            ➕ Tambah Buku
          </a>
        </li>

        <li>
          <a href="{{ route('admin.books.index') }}"
            class="block w-full px-5 py-3 rounded-xl transition font-semibold
              {{ request()->routeIs('admin.books.index') ? 'bg-white shadow-md text-active' : 'hover:bg-white hover:text-active' }}">
            📖 Daftar Buku
          </a>
        </li>

        <li>
         <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
    @csrf
    <button type="submit"
        class="flex items-center gap-2 w-full px-5 py-3 rounded-xl transition font-medium text-red-600 hover:bg-redhover">
        🚪 Logout
    </button>
</form>

        </li>
      </ul>
    </nav>
  </aside>

 <main
  x-data="{ show: false }"
  x-init="setTimeout(() => show = true, 100)"
  x-show="show"
  x-transition.opacity.duration.500ms
  class="ml-64 p-10"
>
  <header class="mb-6">
    <h1 class="text-4xl font-bold text-gray-800">@yield('title')</h1>
  </header>

  <div class="text-lg text-gray-900">
    @yield('content')
  </div>
</main>

@stack('scripts')

</body>
</html>
