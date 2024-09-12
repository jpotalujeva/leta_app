<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="./node_modules/preline/dist/preline.js"></script>

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body>
      <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between">
          <a class="flex-none font-semibold text-xl text-black focus:outline-none focus:opacity-80" href="#" aria-label="Brand">Face Palm App</a>
          <div class="flex flex-row items-center gap-5 mt-5 pb-2 overflow-x-auto sm:justify-end sm:mt-0 sm:ps-5 sm:pb-0 sm:overflow-x-visible [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
            @auth
              <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400" href="{{ url('dashboard') }}">Dashboard</a>
            @else
              <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400" href="{{ route('login') }}">Login</a>
              <a class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400" href="{{ route('register') }}">Register</a>
            @endauth
          </div>
        </nav>
      </header>
      @yield('content')
    </body>
</html>
