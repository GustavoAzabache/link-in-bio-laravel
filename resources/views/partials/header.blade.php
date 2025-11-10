<header class="bg-white">
  <div class="mx-auto flex h-16 max-w-7xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    {{-- Logo --}}
    <div class="flex items-center">
        <img src="{{ asset('storage/app-logo.png') }}" alt="My Bio Link" class="h-14 w-auto">
    </div>

    <div class="flex flex-1 items-center justify-end md:justify-between">
      <nav aria-label="Global" class="hidden md:block">
        <ul class="flex items-center gap-6 text-sm">
          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75" href="/">Inicio</a>
          </li>
        </ul>
      </nav>

      <div class="flex items-center gap-4">
        @guest
          <div class="sm:flex sm:gap-4">
            <a
              class="block rounded-md bg-[#13c5ed] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#10b9de]"
              href="{{ route('login') }}"
            >
              Ingresar
            </a>

            <a
              class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-[#13c5ed] transition hover:text-[#10b9de] sm:block"
              href="{{ route('register') }}"
            >
              Registrarse
            </a>
          </div>
        @endguest

        @auth
          <div class="sm:flex sm:items-center sm:gap-4">
            <span class="text-gray-600 text-sm">Hola, {{ Auth::user()->name }}</span>

            <button
                class="block rounded-md bg-[#13c5ed] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#10b9de]"
            >
              <a href="{{ route('dashboard') }}">Dashboard</a>
            </button>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="block rounded-md bg-red-500 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-red-600">
                Cerrar sesión
              </button>
            </form>
          </div>
        @endauth

        <button class="block rounded-sm bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden">
          <span class="sr-only">Toggle menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>
