@extends('layouts.main')

@section('container')

<main>
  <div class="container mx-auto pt-8 md:px-10 lg:px-16">
    <div class="w-full text-center mb-6">
      <h2 class="text-3xl font-bold text-secondary">Orders</h2>
    </div>
    
    @if (session()->has('success'))
      <div class="w-full p-2 lg:w-2/3 xl:w-1/2 mt-4 mx-auto" id="alert">
        <div class="flex items-center justify-between bg-green-100 border border-green-600 text-green-600 px-4 py-3 rounded-lg">
          {{ session('success') }}
          <button id="close-alert" onclick="closeAlert()"><span data-feather="x"></span></button>
        </div>
      </div>
    @endif
    
    @if (session()->has('successPay'))
      <div id="pay-success" class="fixed top-0 left-0 right-0 bottom-0 bg-[rgba(0,0,0,0.25)] z-40 flex justify-center items-center p-4" onclick="closeSuccess()"></div>
      <div id="success-alert" class="flex flex-col items-center justify-center z-50 w-11/12 sm:w-1/2 md:w-3/5 lg:w-1/3 px-6 py-8 bg-white rounded-lg fixed top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 animate-appear">
        <span data-feather="check-circle" class="w-24 h-24 text-green-500"></span>
        <div class="flex flex-col items-center">
          <div class="mt-6 mb-4 text-2xl text-slate-700 font-bold">{{ session('successPay') }}</div>
          <a href="" class="px-6 py-3 bg-primary text-white font-semibold rounded-md hover:brightness-90">print receipt</a>
        </div>
      </div>
    @endif

    @if ($orderDetails->count())
      <div class="flex flex-col items-center">
        @foreach ($orderDetails as $orderDetail)
          <div class="w-full p-2 lg:w-2/3 xl:w-1/2">
            <div class="flex flex-wrap overflow-hidden rounded-xl bg-white border border-slate-300">
              <div class="bg-slate-300 w-2/5 h-[6.25rem] md:h-32">
                @if ($orderDetail->product->image)
                  <img src="{{ asset('storage/' . $orderDetail->product->image) }}" alt="{{ $orderDetail->product->category->name }}" class="object-cover w-full h-full">
                @else
                  <img src="https://source.unsplash.com/400x300?{{ $orderDetail->product->category->name }}" alt="{{ $orderDetail->product->category->name }}" class="object-cover w-full h-full">
                @endif
              </div>
              <div class="w-3/5 p-2 pl-3 relative">
                <h3 class="block truncate text-lg font-semibold text-secondary hover:text-slate-700">
                  <a href="/menu/{{ $orderDetail->product->slug }}">
                    {{ $orderDetail->product->name }}
                  </a>
                </h3>
                <a href="/menu?category={{ $orderDetail->product->category->slug }}" class="text-xs text-slate-500 py-0.5 px-1.5 rounded-xl border border-slate-500 hover:bg-slate-300">
                  {{ $orderDetail->product->category->name }}
                </a>
                <div class="md:mt-5 flex justify-between items-center">
                  <div class="mt-1.5 text-sm md:text-base font-semibold text-primary">Rp. {{ $orderDetail->product->price }}</div>
                  <div class="flex">
                    <form action="/orders/{{ $orderDetail->id }}" method="post" class="flex">
                      @method('put')
                      @csrf
                      <div class="flex mr-2">
                        <button type="button" class="btn-minus w-6 h-8 md:w-10 md:h-10 flex justify-center items-center rounded-l-md border border-slate-300 bg-white hover:brightness-90"><span data-feather="minus" class="w-4 text-slate-700"></span></button>
                        <input type="number" name="qty" min="1" max="256" class="input-qty w-8 h-8 md:w-[4.5rem] md:h-10 px-2 border-y border-slate-300 focus:outline-none text-slate-700 text-center text-sm md:text-md" value="{{ $orderDetail->qty }}">
                        <button type="button" class="btn-plus w-6 h-8 md:w-10 md:h-10 flex justify-center items-center rounded-r-md border border-slate-300 bg-white hover:brightness-90"><span data-feather="plus" class="w-4 text-slate-700"></span></button>
                      </div>
                      <button type="submit" class="hidden py-1 px-3 md:py-2 md:px-3 rounded-lg bg-green-500 text-white hover:brightness-90"><span data-feather="check" class="w-4 md:w-6"></span></button>
                    </form>
                    <form action="/orders/{{ $orderDetail->id }}" method="post" id="form-delete" class="">
                      @method('delete')
                      @csrf
                      <button type="submit" class="py-1 px-3 md:py-2 md:px-3 rounded-lg bg-red-500 text-white hover:brightness-90"><span data-feather="trash-2" class="w-4 md:w-6"></span></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-slate-700 text-center text-lg font-semibold">
        No orders yet.
      </div>
    @endif

    <div id="pay-confirm" class="fixed top-0 left-0 right-0 bottom-0 bg-[rgba(0,0,0,0.25)] z-40 hidden justify-center items-center p-4" onclick="hidePayConfirm()"></div>
    <div id="confirm-form" class="hidden z-50 w-11/12 sm:w-1/2 md:w-3/5 lg:w-1/3 px-6 py-8 bg-white rounded-lg fixed top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
      <form action="/orders/{{ $order->id }}/pay" method="post">
        @method('put')
        @csrf
        <div class="flex flex-col mb-2">
          <label for="name" class="text-secondary ml-2">Name</label>
          <input type="text" name="name" id="name" class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out" required value="{{ old('name') }}">
        </div>
        <div class="flex flex-col mb-2">
          <label for="total_price" class="text-secondary ml-2">Total price</label>
          <input type="text" name="total_price" id="total_price" class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out" readonly value="{{ $totalPrice }}">
        </div>
        <div class="flex flex-col mb-2">
          <label for="total_paid" class="text-secondary ml-2">Total paid</label>
          <input type="text" name="total_paid" id="total_paid" class="text-slate-700 py-1 px-2 border border-slate-300 rounded-md focus:outline-none focus:border-secondary transition duration-200 ease-in-out" required value="{{ old('total_paid') }}">
        </div>
        <button type="submit" class="w-full mt-4 p-2 text-white font-semibold bg-primary rounded-md">Confirm</button>
      </form>
    </div>

    @if ($orderDetails->count())
      <a id="pay-btn" class="py-3 px-8 rounded-lg bg-primary text-2xl text-white fixed bottom-20 right-4 md:right-14 lg:right-20 shadow-xl z-20 hover:brightness-90 flex items-center" onclick="showPayConfirm()"><span data-feather="dollar-sign" class="w-6 h-6 mr-1"></span>Pay</a>
    @endif

  </div>
</main>

<script>
  function closeAlert() {
    const alert = document.querySelector('#alert');
  
    alert.classList.add('hidden');
  }

  function closeSuccess() {
    const bg = document.querySelector('#pay-success');
    const alert = document.querySelector('#success-alert');

    bg.classList.remove('flex');
    bg.classList.add('hidden');
    alert.classList.add('hidden');
  }

  function showPayConfirm() {
    const payConfirm = document.querySelector('#pay-confirm');
    const confirmForm = document.querySelector('#confirm-form');

    payConfirm.classList.remove('hidden');
    payConfirm.classList.add('flex');
    confirmForm.classList.remove('hidden');
  }

  function hidePayConfirm() {
    const payConfirm = document.querySelector('#pay-confirm');
    const confirmForm = document.querySelector('#confirm-form');

    payConfirm.classList.add('hidden');
    payConfirm.classList.remove('flex');
    confirmForm.classList.add('hidden');
  }

  let clicked = false;

  document.addEventListener('click', function (e) {

    let target = e.target;

    if (target.tagName == 'svg') {
      target = target.parentElement;
    }

    if (target.classList.contains('btn-minus')) {
      const qty = target.nextElementSibling;
      const qtyVal = parseInt(qty.value);
      if( qtyVal > 1 ) qty.value = qtyVal - 1;
      if (!clicked) {
        target.parentElement.nextElementSibling.classList.remove('hidden');
        target.parentElement.parentElement.nextElementSibling.classList.add('invisible');
        clicked = true;
      }
    }
    
    if (target.classList.contains('btn-plus')) {
      const qty = target.previousElementSibling;
      const qtyVal = parseInt(qty.value);
      if( qtyVal < 256 ) qty.value = qtyVal + 1;
      if(!clicked) {
        target.parentElement.nextElementSibling.classList.remove('hidden');
        target.parentElement.parentElement.nextElementSibling.classList.add('invisible');
        clicked = true;
      }
    }


  });



</script>

@endsection