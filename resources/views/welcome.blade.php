<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Laravel Breeze</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Required for Breeze --}}
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 1.5s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-100 to-indigo-200 min-h-screen flex flex-col">

    <header class="flex justify-end p-6 space-x-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="text-blue-700 font-semibold hover:text-blue-900 transition">
                   Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-blue-700 font-semibold hover:text-blue-900 transition">
                   Login | 
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="text-blue-700 font-semibold hover:text-blue-900 transition">
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </header>

    <main class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <h1 class="font-bold text-gray-800 mb-4 animate-fadeInUp">
            Welcome to Laravel Breeze 🚀
        </h1>
        <p class="text-lg text-gray-600 animate-fadeInUp delay-200">
            Simple, clean, and ready to launch your next awesome application.
        </p>
    </main>

</body>
</html>
