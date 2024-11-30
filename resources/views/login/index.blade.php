@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">
    <div class="w-full text-center mb-6">
      <h2 class="text-3xl font-bold text-secondary">Login</h2>
    </div>

    @if (session()->has('success'))
      <div class="w-full p-2 mx-auto md:w-2/5" id="alert">
        <div class="flex items-center justify-between bg-green-100 border border-green-600 text-green-600 px-4 py-3 rounded-lg">
          {{ session('success') }}
          <button id="close-alert" onclick="closeAlert()"><span data-feather="x"></span></button>
        </div>
      </div>
    @endif
    
    @if (session()->has('loginError'))
      <div class="w-full p-2 mx-auto md:w-2/5" id="alert">
        <div class="flex items-center justify-between bg-red-100 border border-red-600 text-red-600 px-4 py-3 rounded-lg">
          {{ session('loginError') }}
          <button id="close-alert" onclick="closeAlert()"><span data-feather="x"></span></button>
        </div>
      </div>
    @endif

    <div class="w-full p-2 mx-auto md:w-2/5">
      <form action="/login" method="post">
        @csrf
        <div class="flex flex-col mb-2">
          <label for="email" class="text-secondary ml-2 @error('email') error-text @enderror">Email address</label>
          <input type="email" name="email" id="email"  class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out @error('email') error-border @enderror" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
          @error('email')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="password" class="text-secondary ml-2">Password</label>
          <input type="password" name="password" id="password"  class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out @error('password') error-border @enderror" placeholder="Password" required>
        </div>
        <button class="mt-4 w-full py-2 bg-primary rounded-md font-semibold text-white hover:bg-sky-800 transition duration-200 ease-in-out" type="submit">Login</button>
      </form>
      <div class="mt-2 text-sm text-slate-800">Not registered? <a href="/register" class="underline text-secondary">Register Now!</a></div>
    </div>

  </div>
</main>

<script>
  function closeAlert() {
    const alert = document.querySelector('#alert');
  
    alert.classList.add('hidden');
  }

</script>

@endsection