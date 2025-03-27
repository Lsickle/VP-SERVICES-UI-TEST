<!-- Sidebar -->
<div id="sidebar"
  class="fixed top-0 left-0 bg-gray-800 text-white w-auto max-w-xs h-screen p-4 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">

  <!-- Se agrega una Barra de búsqueda -->
  <div class="mb-4">
    <input id="sidebarSearch" type="text" placeholder="Buscar..."
      class="w-full p-2 rounded bg-gray-700 text-white placeholder-gray-400">
  </div>

  <ul id="sidebarList" class="text-sm md:text-base">
    @guest
    <!-- Opciones para usuarios no autenticados -->
    <h2 class="mb-2">Menú de Opciones</h2>
    <li>
      <a href="{{ route('bienvenido') }}" class="block p-2 hover:bg-gray-700">Inicio</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Iniciar Sesión</a>
    </li>
    <hr class="my-2 border-gray-600">
    <h2 class="mb-2">Agendamientos</h2>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Agendar Visita</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Descargo de Pedidos</a>
    </li>
    @endguest

    @auth
    <!-- Opción general para usuarios autenticados -->
    <h2 class="mb-2">Menú de Opciones</h2>
    <li>
      <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-700">Panel de Control</a>
    </li>
    <hr class="my-2 border-gray-600">

    <!-- Opciones adicionales para usuarios autenticados con rol de Administrador -->
    @if(request()->routeIs('dashboard.administrador') && auth()->user()->hasRole('Administrador'))
    <h2 class="mb-2">Opciones Administrador</h2>
    <li>
      <a href="{{ route('usuarios.index') }}" class="block p-2 hover:bg-gray-700">Gestión de Usuarios</a>
    </li>
    <li>
      <a href="{{ route('operaciones.index') }}" class="block p-2 hover:bg-gray-700">Operaciones</a>
    </li>
    <li>
      <a href="{{ route('seguridad.roles.index') }}" class="block p-2 hover:bg-gray-700">Gestión de Roles</a>
    </li>
    <li>
      <a href="{{ route('seguridad.permisos.index') }}" class="block p-2 hover:bg-gray-700">Permisos</a>
    </li>
    @endif

    <!-- Opciones adicionales para usuarios autenticados con rol de Autorizador -->
    @if(request()->routeIs('dashboard.autorizador') && auth()->user()->hasRole('Autorizador'))
    <h2 class="mb-2">Opciones Administrador</h2>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Gestion Solicitudes</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Nuevas Solicitudes</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Solicitudes Pendientes</a>
    </li>
    @endif

    @endauth
  </ul>
</div>