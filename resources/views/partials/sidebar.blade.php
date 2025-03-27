<!-- Sidebar -->
<div id="sidebar"
  class="fixed top-0 left-0 bg-gray-800 text-white w-auto max-w-xs h-screen p-4 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50">
  <ul class="text-sm md:text-base">
    @guest
    <!-- Opciones para usuarios no autenticados -->
    <h2 class="mb-2">Menu de Opciones</h2>
    <li>
      <a href="{{ route('bienvenido') }}" class="block p-2 hover:bg-gray-700">Home</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Iniciar Sesión</a>
    </li>
    <h2 class="mb-2">Agendamientos</h2>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Agendar Visita</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Descargo de Pedidos</a>
    </li>
    @endguest

    @auth
    <!-- Opciones para usuarios autenticados -->
    @if(request()->routeIs('dashboard.administrador'))
    @if(auth()->user()->hasRole('Administrador'))
    <h2 class="mb-2">Panel Administrador</h2>
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
    @else
    <!-- Otras opciones para usuarios autenticados en otras rutas -->
    <li>
      <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-700">Dashboard</a>
    </li>
    @endif
    @endauth
  </ul>
</div>