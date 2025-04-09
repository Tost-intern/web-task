<x-guest-layout>
    <div class="bg-gradient-to-b from-gray-900 to-gray-800 min-h-screen flex items-center justify-center px-6">
        <div class="max-w-4xl text-center text-white space-y-6">
            <h1 class="text-5xl sm:text-6xl font-extrabold tracking-tight">
                Welcome to <span class="text-blue-400">ShopSwift</span>
            </h1>

            <p class="text-xl sm:text-2xl text-gray-300">
                Discover the latest trends and unbeatable prices — all in one place.
            </p>

            @auth
                <p class="text-green-400">Welcome back, {{ Auth::user()->name }}!</p>
                <a href="{{ route('dashboard') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg shadow transition">
                    Go to Dashboard
                </a>
            @else
                <div class="flex justify-center space-x-4 mt-6">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg text-lg transition shadow">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-5 py-2 rounded-lg text-lg transition shadow">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</x-guest-layout>
