@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">

    <div class="w-full mx-auto p-2 md:w-2/3">
      <div class="flex flex-wrap overflow-hidden rounded-xl bg-white border border-slate-300">
        <div class="bg-slate-300 h-32 w-full md:h-64">
          @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
          @else
            <img src="https://source.unsplash.com/400x300?{{ $product->category->name }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
          @endif
        </div>
        <div class="w-full p-2 md:pl-4 relative">
          <h3 class="block truncate text-2xl font-semibold text-secondary">
            {{ $product->name }}
          </h3>
          <a href="/menu?category={{ $product->category->name }}" class="text-xs text-slate-500 py-0.5 px-1.5 rounded-xl border border-slate-500 hover:bg-slate-300">
            {{ $product->category->name }}
          </a>
          <div class="min-h-24 py-4">
            <p class="text-secondary text-justify">
              {{ $product->description }}
            </p>
          </div>
          <div class="flex justify-between items-center">
            <div class="mt-1.5 text-lg font-semibold text-primary">Rp. {{ $product->price }}</div>
            @auth  
              <form action="">
                <button type="submit" class="block py-3 px-5 rounded-lg bg-primary text-white hover:brightness-90"><span data-feather="shopping-cart" class="w-8 h-8"></span></button>
              </form>
            @endauth
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

@endsection