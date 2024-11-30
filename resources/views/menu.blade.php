@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">
    <div class="w-full text-center mb-6">
      <h2 class="text-3xl font-bold text-secondary">Our Menu</h2>
    </div>

    <div class="w-full px-4 mb-8 md:w-2/3 lg:w-1/2 mx-auto">
      <form action="/menu">
        @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <div class="flex">
          <input type="text" name="search" id="search" class="text-sm text-slate-500 py-1 px-2 rounded-tl-lg rounded-bl-lg border border-slate-300 w-4/5 focus:outline-none focus:border-secondary transition duration-200 ease-in-out" value="{{ request('search') }}">
          <button type="submit" class="p-1.5 rounded-tr-lg rounded-br-lg flex justify-center border border-slate-300 w-1/5 bg-slate-300 text-secondary hover:bg-secondary hover:border-secondary hover:text-white transition duration-200 ease-in-out"><i data-feather="search"></i></button>
        </div>
      </form>
      @if (session()->has('success'))
        <div class="w-full mt-4" id="alert">
          <div class="flex items-center justify-between bg-green-100 border border-green-600 text-green-600 px-4 py-3 rounded-lg">
            {{ session('success') }}
            <button id="close-alert" onclick="closeAlert()"><span data-feather="x"></span></button>
          </div>
        </div>
      @endif
    </div>
    

    @if ($products->count())
      <div class="flex flex-wrap">
        @foreach ($products as $product)  
          <div class="w-full p-2 md:w-1/3 lg:w-1/4">
            <div class="flex flex-wrap overflow-hidden rounded-xl bg-white border border-slate-300">
              <div class="bg-slate-300 w-2/5 h-[108px] md:w-full md:h-40">
                @if ($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
                @else
                  <img src="https://source.unsplash.com/400x300?{{ $product->category->name }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
                @endif
              </div>
              <div class="w-3/5 p-2 relative md:w-full">
                <h3 class="block truncate text-lg font-semibold text-secondary hover:text-slate-700">
                  <a href="/menu/{{ $product->slug }}">
                    {{ $product->name }}
                  </a>
                </h3>
                <a href="/menu?category={{ $product->category->slug }}" class="text-xs text-slate-500 py-0.5 px-1.5 rounded-xl border border-slate-500 hover:bg-slate-300">
                  {{ $product->category->name }}
                </a>
                <div class="flex justify-between items-center">
                  <div class="mt-1.5 text-md font-semibold text-primary">Rp. {{ $product->price }}</div>
                  @auth  
                    <a href="/orders/{{ $product->slug }}" class="block py-2 px-3 rounded-lg bg-primary text-white hover:brightness-90"><span data-feather="plus-circle"></span></a>
                  @endauth
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-slate-700 text-center text-lg font-semibold">
        No product found.
      </div>
    @endif

    <div class="flex justify-center px-2 mt-6">
      {{ $products->links() }}
    </div>

  </div>
</main>

<script>
  function closeAlert() {
    const alert = document.querySelector('#alert');
    const closeAlert = document.querySelector('#close-alert');
  
    alert.classList.add('hidden');
  }

</script>

@endsection