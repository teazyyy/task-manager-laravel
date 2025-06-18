<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    <header class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">Task Manager</h1>
            <div class="flex space-x-4">
                {{-- Valodas pārslēgšana --}}
                <a href="/lang/lv" class="text-sm hover:underline">LV</a>
                <a href="/lang/en" class="text-sm hover:underline">EN</a>

                {{-- Pieteikšanās / Iziet --}}
                @auth
                    <span>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:underline">Iziet</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-sm hover:underline">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto p-4">
        {{-- Flash ziņojumi --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validācijas kļūdas --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white shadow p-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Task Manager. {{ __('messages.all_rights_reserved') ?? '' }}
    </footer>

</body>
</html>
