<header class="absolute h-20 left-0 top-0 z-30 flex w-full items-center bg-white shadow-md transition-all duration-300 ease-in-out">
  <div class="container mx-auto md:px-10 lg:px-16">
    <div class="relative flex items-center justify-between">
      <div class="px-4">
        <h1>
          <a href="#" id="title" class="block text-2xl font-bold text-primary">
            coffeeshop
          </a>
        </h1>
      </div>
      <div class="flex items-center px-4">
        <button id="hamburger" name="hamburger" type="button" class="absolute right-4 block lg:hidden">
          <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
          <span class="hamburger-line transition duration-300 ease-in-out"></span>
          <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
        </button>

        <nav
          id="nav-menu"
          class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:max-w-full lg:py-0 lg:rounded-none lg:bg-transparent lg:shadow-none"
        >
          <ul class="block lg:flex items-center">
            <li class="group">
              <a
                href="{{ route('home') }}"
                class="block mx-6 lg:mx-8 py-2 text-base group-hover:text-sky-800 text-primary font-bold transition duration-200 ease-in-out {{ Request::is('/') ? 'text-sky-800' : '' }}"
                >home</a
              >
            </li>
            <li class="group">
              <a
                href="{{ route('menu') }}"
                class="block mx-6 lg:mx-8 py-2 text-base group-hover:text-sky-800 text-primary font-bold transition duration-200 ease-in-out {{ Request::is('menu*') ? 'text-sky-800' : '' }}"
                >menu</a
              >
            </li>
            <li class="group">
              <a
                href="{{ route('categories') }}"
                class="block mx-6 lg:mx-8 py-2 lg:py-0 text-base group-hover:text-sky-800 text-primary font-bold transition duration-200 ease-in-out {{ Request::is('categories') ? 'text-sky-800' : '' }}"
                >categories</a
              >
            </li>
            @can('admin')
              <li class="group">
                <a
                href="{{ route('manage') }}"
                class="block mx-6 lg:mx-8 py-2 lg:py-0 text-base group-hover:text-sky-800 text-primary font-bold transition duration-200 ease-in-out"
                >manage</a
                >
              </li>
            @endcan
            @auth 
              <li class="group">
                <form action="/logout" method="post">
                  @csrf
                  <div class="mx-6 mt-2 lg:mt-0 lg:mx-8">
                    <button type="submit" class="w-full py-2 px-6 text-base group-hover:bg-red-800 text-white font-bold bg-red-500 rounded-lg transition duration-200 ease-in-out">Logout</button>
                  </div>
                </form>
              </li>
            @else
              <li class="group">
                <a
                  href="{{ route('login') }}"
                  class="mx-6 mt-2 lg:mt-0 lg:mx-8 block text-center py-2 px-6 text-base group-hover:bg-sky-800 text-white font-bold bg-primary rounded-lg transition duration-200 ease-in-out"
                  >login</a
                >
              </li>
            @endauth
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
