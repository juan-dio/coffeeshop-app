@extends('layouts.main')

@section('container')

<main>

  <div class="container mx-auto pt-8 md:px-10 lg:px-16">
    <div class="w-full text-center mb-6">
      <h2 class="text-3xl font-bold text-secondary">Categories</h2>
    </div>

    <div class="flex flex-wrap">
      @foreach ($categories as $category)
        <a href="/menu?category={{ $category->slug }}" class="w-full p-2 md:w-1/3 lg:w-1/4">
          <div class="overflow-hidden rounded-xl border border-slate-300 bg-slate-300 bg-cover bg-center h-28 relative">
            <div class="bg-slate-300 w-full h-full">
              @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="object-cover w-full h-full">
              @else
                <img src="https://source.unsplash.com/400x300?{{ $category->name }}" alt="{{ $category->name }}" class="object-cover w-full h-full">
              @endif
            </div>
            <div class="absolute top-0 left-0 flex justify-center items-center w-full h-full bg-[rgba(0,0,0,0.25)]">
              <h3 class="text-white text-3xl font-bold">
                {{ $category->name }}
              </h3>
            </div>
          </div>
        </a>
      @endforeach
    </div>

  </div>

  
</main>

@endsection