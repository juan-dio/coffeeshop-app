<header class="fixed top-0 left-0 right-0 w-full bg-white shadow-lg md:w-1/4 md:fixed md:top-0 md:left-0 md:bottom-0 lg:w-1/6">

  <div class="container">
    <div class="flex flex-col p-2 pb-0 bg-white">
      <div class="px-2 py-3 pb-4 border-b border-slate-300 flex justify-between items-center">
        <h1>
          <a href="/manage" class="text-secondary text-xl font-bold">
            Manage Coffeeshop
          </a>
        </h1>
        <button class="h-6 flex items-center md:hidden transition duration-200 ease-in-out" id="nav-btn">
          <span class="inline-block bg-secondary w-4 h-1 rotate-[35deg]"></span>
          <span class="inline-block bg-secondary w-4 h-1 -rotate-[35deg] -ml-1"></span>
        </button>
      </div>
    </div>
    <div class="px-4 overflow-hidden h-0 md:h-fit transition-all duration-200 ease-in-out" id="nav-menu">
      <nav>
        <ul>
          <li class="group py-1.5">
            <a
              href="/manage/menu"
              class="text-slate-600 text-md flex items-center hover:font-medium hover:text-slate-950 {{ Request::is('manage/menu*') ? 'font-medium text-slate-950' : '' }}"
              ><span data-feather="book" class="w-4 mr-1.5"></span> menu</a
            >
          </li>
          <li class="group py-1.5">
            <a
              href="/manage/categories"
              class="text-slate-600 text-md flex items-center hover:font-medium hover:text-slate-950 {{ Request::is('manage/categories*') ? 'font-medium text-slate-950' : '' }}"
              ><span data-feather="grid" class="w-4 mr-1.5"></span> category</a
            >
          </li>
          <li class="group py-1.5">
            <a
              href="/manage/orders"
              class="text-slate-600 text-md flex items-center hover:font-medium hover:text-slate-950 {{ Request::is('manage/orders*') ? 'font-medium text-slate-950' : '' }}"
              ><span data-feather="dollar-sign" class="w-4 mr-1.5"></span> orders</a
            >
          </li>
          <li class="group py-1.5">
            <a
              href="{{ route('home') }}"
              class="text-slate-600 text-md flex items-center hover:font-medium hover:text-slate-950"
              ><span data-feather="corner-down-left" class="w-4 mr-1.5"></span>back to main page</a
            >
          </li>
        </ul>
      </nav>
      <div class="py-4 md:absolute md:bottom-6 md:py-0">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="text-secondary text-xl flex items-center font-medium hover:text-sky-950 transition duration-200 ease-in-out"><span data-feather="log-out" class="w-4 mr-1.5"></span> Logout</button>
        </form>
      </div>
    </div>
  </div>

</header>