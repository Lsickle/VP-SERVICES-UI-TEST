<!-- resources/views/components/sidebar.blade.php -->
<nav @click.away="open = false" :class="open ? 'translate-x-0' : '-translate-x-64'"
  class="bg-blue-800 shadow-xl w-64 fixed h-full border-r border-gray-200 transform transition-transform duration-200 lg:translate-x-0 z-50">
  <div class="p-4">
    <!-- Botón para cerrar el menú en móviles -->
    <button @click="open = false" class="lg:hidden text-white text-2xl mb-4" aria-label="Cerrar menú">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
    <!-- Menú del Sidebar -->
    <div class="space-y-1">
      <a href="{{ route('dashboard') }}"
        class="flex items-center p-3 text-white hover:bg-orange-500 rounded-lg transition-all">
        <!-- Ícono SVG para Menú Principal (Sidebar) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
        </svg>  
        <span class="ml-3 font-medium"> Menú Principal</span>
      </a>

      @can('Administrar Usuarios')
      <a href="{{ route('usuarios.index') }}"
        class="flex items-center p-3 text-white hover:bg-orange-500 rounded-lg transition-all">
        <!-- Ícono SVG para Usuarios (persona) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="ml-3 font-medium"> Usuarios</span>
      </a>
      @endcan

      @can('Administrar Permisos')
      <a href="{{ route('seguridad.permisos.index') }}"
        class="flex items-center p-3 text-white hover:bg-orange-500 rounded-lg transition-all">
        <!-- Ícono SVG para Permisos -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="ml-3 font-medium"> Permisos</span>
      </a>
      @endcan

      @can('Administrar Roles')
      <a href="{{ route('seguridad.roles.index') }}"
        class="flex items-center p-3 text-white hover:bg-orange-500 rounded-lg transition-all">
        <!-- Ícono SVG para Roles -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="ml-3 font-medium"> Roles</span>
      </a>
      @endcan

      @can('Administrar Operaciones')
      <a href="{{ route('operaciones.index') }}"
        class="flex items-center p-3 text-white hover:bg-orange-500 rounded-lg transition-all">
        <!-- Ícono SVG para Operaciones -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
          class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 9.75V17a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 17V9.75M3 9.75l9-5.25 9 5.25M3 9.75l9 5.25m9-5.25l-9 5.25m0 0v6" />
        </svg>
        <span class="ml-3 font-medium"> Operaciones</span>
      </a>
      @endcan
      {{-- Otros enlaces si es necesario --}}
    </div>
  </div>
</nav>