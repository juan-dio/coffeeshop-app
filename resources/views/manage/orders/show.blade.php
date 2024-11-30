@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container py-8 px-2 md:px-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">Order Details</h2>
    </div>
    
    <div class="md:w-3/4">
      <a href="/manage/orders" class="flex items-center w-fit mb-2 px-4 py-2 rounded-md text-white bg-green-500 hover:brightness-90"><span data-feather="arrow-left" class="mr-1"></span> Back to orders</a>
      <table class="w-full border-collapse bg-white">
        <tr class="border-b border-slate-800 text-slate-800 text-sm font-semibold">
          <th class="text-left p-1">#</th>
          <th class="text-left p-1">Product</th>
          <th class="text-left p-1">Qty</th>
          <th class="text-left p-1">Accumulative Price</th>
        </tr>

        @foreach ($orderDetails as $orderDetail)  
        <tr class="text-slate-800 text-sm @if($loop->iteration % 2 == 1) bg-slate-300 @endif">
          <td class="p-1">{{ $loop->iteration }}</td>
          <td class="p-1">{{ $orderDetail->product->name }}</td>
          <td class="p-1">{{ $orderDetail->qty }}</td>
          <td class="p-1">{{ $orderDetail->qty * $orderDetail->product->price }}</td>
        </tr>
        @endforeach

      </table>
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