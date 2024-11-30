<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Coffeeshop | {{ $page }}</title>
  
  {{-- Tailwind CSS --}}
  <link rel="stylesheet" href="/css/output.css">

</head>
<body class="bg-white">

  @include('layouts.navbar')

  <div class="pt-20 min-h-[800px] pb-20">

    @yield('container')

  </div>

  @if (Auth::check() && !Request::is('/') && !Request::is('orders*') && !Request::is('login*') && !Request::is('register*'))
    <a href="/orders" class="p-6 rounded-full bg-primary text-white fixed bottom-20 right-4 md:right-12 shadow-lg z-20 hover:brightness-90"><span data-feather="shopping-cart" class="w-10 h-10"></span></a>
  @endif


  <footer>
    <div class="text-xs text-center text-slate-500 border-t border-slate-300 py-6">
      <p>
        Copyright © Juan Dio - coffeeshop-app.
      </p>
      <p>
        Made with <a href="https://laravel.com/" class="text-red-600 font-semibold">Laravel</a> & <a href="https://tailwindcss.com/" class="text-sky-600 font-semibold">TailwindCSS</a>
      </p>
    </div>
  </footer>

<script src="/js/feather.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>