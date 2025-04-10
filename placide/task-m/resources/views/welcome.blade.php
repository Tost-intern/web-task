<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Task Management System</title>
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <style>
        body { font-family: 'Instrument Sans', sans-serif; }
      </style>
    @endif
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  <body
    class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-black text-gray-800 dark:text-gray-200 min-h-screen"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || window.matchMedia('(prefers-color-scheme: dark)').matches, mobileMenu: false, scrolled: false }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val)); window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
    :class="{ 'dark': darkMode }"
  >
    <!-- Header -->
    <header class="fixed w-full z-50 transition-all duration-300" :class="scrolled ? 'bg-white/90 dark:bg-gray-900/90 shadow-md backdrop-blur' : 'bg-transparent'">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <svg class="h-8 w-8 text-rose-600 dark:text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <span class="text-xl font-bold text-gray-900 dark:text-white">TaskMaster</span>
        </div>
        
        <!-- Right Side Actions -->
        <div class="flex items-center space-x-4">
          <!-- Dark Mode Toggle -->
          <button @click="darkMode = !darkMode" class="theme-toggle" aria-label="Toggle dark mode">
            <svg x-show="!darkMode" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <svg x-show="darkMode" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </button>
          
          <!-- Dashboard Button (if logged in) -->
          @auth
            <a href="{{ url('/dashboard') }}" class="btn-primary">Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="btn-primary">Get Started</a>
          @endauth
        </div>
      </div>
    </header>

    <!-- Hero -->
    <section class="pt-32 pb-20 md:pt-40 md:pb-32">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
          <h1 
            class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6 text-gray-900 dark:text-white tracking-tight transition-all duration-700 transform"
            :class="show ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
          >
            Manage Tasks with <span class="text-rose-600 dark:text-rose-500 inline-block">Efficiency & Ease</span>
          </h1>
          <p 
            class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-10 max-w-3xl mx-auto transition-all duration-700 delay-300 transform"
            :class="show ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
          >
            Streamline your workflow, boost productivity, and collaborate seamlessly with our powerful task platform.
          </p>
          <div 
            class="flex flex-wrap justify-center gap-4 transition-all duration-700 delay-500 transform"
            :class="show ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'"
          >
            @auth
              <a href="{{ url('/dashboard') }}" class="btn-primary-lg">Go to Dashboard</a>
            @else
              <a href="{{ route('register') }}" class="btn-primary-lg">Get Started</a>
              <a href="{{ route('login') }}" class="btn-secondary-lg">Login</a>
            @endauth
          </div>
        </div>
      </div>
    </section>

    <!-- Custom Tailwind Styles -->
    <style>
      .btn-primary {
        @apply px-5 py-2 bg-rose-600 text-white rounded-md font-medium hover:bg-rose-700 transition shadow-sm hover:shadow;
      }
      .btn-secondary {
        @apply px-5 py-2 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-md font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition shadow-sm hover:shadow;
      }
      .btn-primary-lg {
        @apply px-8 py-3 bg-rose-600 text-white rounded-md font-medium hover:bg-rose-700 transition shadow-md hover:shadow-lg text-lg;
      }
      .btn-secondary-lg {
        @apply px-8 py-3 border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-md font-medium hover:bg-gray-100 dark:hover:bg-gray-700 transition shadow-md hover:shadow-lg text-lg;
      }
      .icon {
        @apply w-5 h-5;
      }
      .theme-toggle {
        @apply p-2 rounded-full bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 transition flex items-center justify-center;
      }
    </style>
  </body>
</html>
