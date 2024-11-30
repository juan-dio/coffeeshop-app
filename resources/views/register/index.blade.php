@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">
    <div class="w-full text-center mb-6">
      <h2 class="text-3xl font-bold text-secondary">Register</h2>
    </div>

    <div class="w-full p-2 mx-auto md:w-2/5">
      <form action="/register" method="post">
        @csrf
        <div class="flex flex-col mb-2">
          <label for="name" class="text-secondary ml-2 @error('name') error-text @enderror">Name</label>
          <input type="name" name="name" id="name"  class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out @error('name') error-border @enderror" placeholder="name@example.com" autofocus required value="{{ old('name') }}">
          @error('name')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="email" class="text-secondary ml-2 @error('email') error-text @enderror">Email</label>
          <input type="email" name="email" id="email"  class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out @error('email') error-border  @enderror" placeholder="name@example.com" autofocus value="{{ old('email') }}">
          @error('email')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="password" class="text-secondary ml-2 @error('password') error-text @enderror">Password</label>
          <input type="password" name="password" id="password"  class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out @error('password') error-border @enderror" placeholder="Password" required>
        </div>
        <button class="mt-4 w-full py-2 bg-primary rounded-md font-semibold text-white hover:bg-sky-800 transition duration-200 ease-in-out" type="submit">Register</button>
      </form>
      <div class="mt-2 text-sm text-slate-800">Already registered? <a href="/login" class="underline text-secondary">Login Now!</a></div>
    </div>

  </div>
</main>

@endsection