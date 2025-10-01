<div x-data="{ open: true }" class="flex">
    <!-- Sidebar -->
    <div :class="open ? 'w-64' : 'w-16'"
         class="bg-gray-800 text-white min-h-screen transition-all duration-300 flex flex-col">

        <!-- Toggle button -->
        <button @click="open = !open"
                class="p-3 focus:outline-none hover:bg-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Menu items -->
        <nav class="flex-1 mt-4 space-y-2">
            <a href="#"
               class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition">
                <span class="material-icons">home</span>
                <span x-show="open" class="text-sm">Dashboard</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition">
                <span class="material-icons">settings</span>
                <span x-show="open" class="text-sm">Settings</span>
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 transition">
                <span class="material-icons">logout</span>
                <span x-show="open" class="text-sm">Logout</span>
            </a>
        </nav>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold">Main Content</h1>
        <p>Phần nội dung trang ở đây...</p>
    </div>
</div>
