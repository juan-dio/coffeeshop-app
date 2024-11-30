<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Coffeeshop Admin | {{ $page }}</title>
  
  {{-- Tailwind CSS --}}
  <link rel="stylesheet" href="/css/output.css">

</head>
<body class="bg-slate-200">

  @include('manage.layouts.sidebar')

  <div class="min-h-screen pt-12 md:pt-0 md:pl-[25%] lg:pl-[16.666667%]">

    @yield('container')

  </div>


<script src="/js/feather.min.js"></script>
<script>
  feather.replace();
</script>
<script>
  const navButton = document.querySelector('#nav-btn');
  const navMenu = document.querySelector('#nav-menu');

  navButton.addEventListener('click', function() {
    navMenu.classList.toggle('h-0');
    navMenu.classList.toggle('pt-6');
    navButton.classList.toggle('nav-active');
  });
</script>
</body>
</html>