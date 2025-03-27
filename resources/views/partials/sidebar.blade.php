<!-- Sidebar -->
<div id="sidebar"
  class="fixed inset-y-0 left-0 bg-gray-800 text-white w-64 p-5 transform -translate-x-full md:translate-x-0 md:relative transition-transform duration-300 ease-in-out">
  <ul>
    <li>
      <a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-700">Inicio</a>
    </li>
    @if(request()->routeIs('dashboard.administrador'))
    @if(auth()->user()->hasRole('Administrador'))
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
    @elseif(request()->routeIs('bienvenido'))
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Opción 1</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Opción 2</a>
    </li>
    <li>
      <a href="{{ route('login') }}" class="block p-2 hover:bg-gray-700">Opción 3</a>
    </li>
    @endif
  </ul>
</div>