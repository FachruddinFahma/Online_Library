{{--
<header class="bg-white bg-opacity-80 backdrop-blur-md shadow-xl py-6 sticky top-0 z-50 rounded-b-xl">
    <div class="container mx-auto px-6 flex justify-between items-center">


        <h1 class="text-3xl font-semibold text-gray-800 tracking-wide">
            📚 Dashboard User
        </h1>


        <div class="flex items-center space-x-4">


            <a href="{{ route('user.dashboard') }}"
               class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-6 py-2 rounded-full shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300 ease-in-out text-sm md:text-base font-medium">
                ← Beranda
            </a>


            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2 rounded-full bg-red-100 hover:bg-red-200 text-red-600 font-medium text-sm md:text-base transition-all duration-300">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</header> --}}


<header class="bg-white bg-opacity-80 backdrop-blur-md shadow-xl sticky top-0 z-50 rounded-b-xl" style="padding-top:10px; padding-bottom:20px;">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <h1 class="text-3xl font-semibold text-gray-800 tracking-wide">
            📚 Dashboard User
        </h1>

        <div class="flex items-center space-x-4">
            <a href="{{ route('user.dashboard') }}"
               class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-white px-6 py-2 rounded-full shadow-md hover:shadow-xl hover:scale-105 transition-all duration-300 ease-in-out text-sm md:text-base font-medium">
                ← Beranda
            </a>

            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah kamu yakin ingin logout?')">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2 rounded-full bg-red-100 hover:bg-red-200 text-red-600 font-medium text-sm md:text-base transition-all duration-300">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</header>
