<header class="w-full bg-blue-900 py-4 shadow-lg relative z-10">
    <!-- Header para dispositivos de escritorio -->
    <div class="hidden md:flex items-center justify-center">
        <a href="https://vigiaplus.com/">
            <img src="{{ asset('logos/VigiaLogo.png') }}" alt="Logo Vigia"
                class="w-32 md:w-48 h-auto p-2 bg-white rounded-lg shadow-md">
        </a>
    </div>

    <!-- Header para dispositivos móviles -->
    <div class="flex md:hidden items-center justify-between px-4">
        <a href="https://vigiaplus.com/">
            <img src="{{ asset('logos/VigiaLogo.png') }}" alt="Logo Vigia"
                class="w-32 md:w-48 h-auto p-2 bg-white rounded-lg shadow-md">
        </a>
        <button id="sidebarToggle" class="text-white p-2">
            <span class="material-icons">menu</span>
        </button>
    </div>
</header>