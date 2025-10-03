<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <div x-data="{ open: true }" :class="open ? 'w-64' : 'w-16'"
            class="bg-gray-800 text-white transition-all duration-300 flex flex-col">

            <!-- Toggle -->
            <button @click="open = !open" class="p-3 focus:outline-none hover:bg-gray-700">
                <span class="material-icons">menu</span>
            </button>

            <!-- Menu -->
            <nav class="flex-1 mt-4">
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition">
                            <span class="material-icons">dashboard</span>
                            <span x-show="open" class="text-sm">Dashboard</span>
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('notes.index') }}"
                            class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition">
                            <span class="material-icons">note</span>
                            <span x-show="open" class="text-sm">Note</span>
                        </a>
                    </li>
                    <!-- Settings with submenu -->
                    <li x-data="{ subOpen: false }">
                        <button @click="subOpen = !subOpen"
                            class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition text-left">
                            <span class="material-icons">data_object</span>
                            <span x-show="open" class="text-sm flex-1">Feature</span>
                            <span x-show="open" class="material-icons transform transition"
                                :class="subOpen ? 'rotate-90' : ''">chevron_right</span>
                        </button>

                        <!-- Submenu -->
                        <ul x-show="subOpen && open" x-transition class="ml-10 mt-1 space-y-1 text-sm">
                            <li>
                                <a href="/format-html" class="block px-2 py-1 hover:bg-gray-700 rounded">
                                    Format HTML
                                </a>
                            </li>
                            <li>
                                <a href="/format-json" class="block px-2 py-1 hover:bg-gray-700 rounded">
                                    Format JSON
                                </a>
                            </li>
                            <li>
                                <a href="/format-sql" class="block px-2 py-1 hover:bg-gray-700 rounded">
                                    Format SQL
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition text-left">
                                <span class="material-icons">logout</span>
                                <span x-show="open" class="text-sm">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>


        <!-- Main wrapper -->
        <div class="flex-1 flex flex-col">
            <!-- Top navigation -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
