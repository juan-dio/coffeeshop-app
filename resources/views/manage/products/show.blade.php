@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container py-8 px-2 md:px-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">{{ $product->name }}</h2>
    </div>


    <div class="md:w-1/2">
      <div class="flex mb-3">
        <a href="/manage/menu" class="flex items-center px-4 py-2 mr-1 rounded-md bg-green-500 text-white hover:brightness-90"><span data-feather="arrow-left" class="w-5 mr-1"></span>Back to menu</a>
        <a href="/manage/menu/{{ $product->slug }}/edit" class="flex items-center px-4 py-2 mr-1 rounded-md bg-yellow-500 text-white hover:brightness-90"><span data-feather="edit" class="w-5 mr-1"></span>Edit</a>
        <form action="/manage/menu/{{ $product->slug }}" method="post" class="flex">
          @method('delete')
          @csrf
          <button class="flex items-center px-4 py-2 rounded-md bg-red-500 text-white hover:brightness-90" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" class="w-5 mr-1"></span>Delete</button>
        </form>
      </div>
      <div class="bg-slate-300 h-64 w-full">
        @if ($product->image)
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
        @else
          <img src="https://source.unsplash.com/400x300?{{ $product->category->name }}" alt="{{ $product->category->name }}" class="object-cover w-full h-full">
        @endif
      </div>
      <div class="mt-1.5 text-xl font-semibold text-primary">
        Rp. {{ $product->price }}
      </div>
      <div class="mt-2 text-slate-900">
        {{ $product->description }}
      </div>
    </div>


  </div>
</main>

@endsection