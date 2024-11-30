@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">

    <div class="w-full mx-auto p-2 md:w-3/4 lg:w-1/2">
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
          <div class="flex justify-between items-center mt-4">
            <div class="text-lg font-semibold text-primary">Rp. {{ $product->price }}</div>
            @auth
              <form action="/orders" method="post" class="flex">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="flex mr-4">
                  <button type="button" id="minus" class="w-12 h-12 flex justify-center items-center rounded-l-md border border-slate-300 bg-white hover:brightness-90"><span data-feather="minus" class="w-4 text-slate-700"></span></button>
                  <input type="number" id="qty" name="qty" min="1" max="256" class="w-24 h-12 px-2 border-y border-slate-300 focus:outline-none text-slate-700 text-center" value="1">
                  <button type="button" id="plus" class="w-12 h-12 flex justify-center items-center rounded-r-md border border-slate-300 bg-white hover:brightness-90"><span data-feather="plus" class="w-4 text-slate-700"></span></button>
                </div>
                <button type="submit" class="block py-2 px-3 rounded-lg bg-primary text-white hover:brightness-90"><span data-feather="plus-circle" class="w-8 h-8"></span></button>
              </form>
            @endauth
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<script>
  const qty = document.querySelector('#qty');
  const plus = document.querySelector('#plus');
  const minus = document.querySelector('#minus');

  plus.addEventListener('click', function () {
    const qtyVal = parseInt(qty.value);
    if( qtyVal < 256 ) qty.value = qtyVal + 1;
  });
  
  minus.addEventListener('click', function () {
    const qtyVal = parseInt(qty.value);
    if( qtyVal > 1 ) qty.value = qtyVal - 1;
  });

</script>

@endsection