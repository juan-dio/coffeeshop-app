@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container py-8 px-2 md:px-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">Orders</h2>
    </div>
    
    <div class="md:w-3/4">
      <table class="w-full border-collapse bg-white">
        <tr class="border-b border-slate-800 text-slate-800 text-sm font-semibold">
          <th class="text-left p-1">#</th>
          <th class="text-left p-1">Name</th>
          <th class="text-left p-1">Total Price</th>
          <th class="text-left p-1">Total Paid</th>
          <th class="text-left p-1">Status</th>
          <th class="text-center p-1">Action</th>
        </tr>

        @foreach ($orders as $order)  
        <tr class="text-slate-800 text-sm @if($loop->iteration % 2 == 1) bg-slate-300 @endif">
          <td class="p-1">{{ $loop->iteration }}</td>
          <td class="p-1">{{ $order->name }}</td>
          <td class="p-1">{{ $order->total_price }}</td>
          <td class="p-1">{{ $order->total_paid }}</td>
          <td class="p-1">@if ($order->is_paid) paid @else not paid @endif</td>
          <td class="p-1 flex justify-center">
            <a href="/manage/orders/{{ $order->id }}" class="px-2 py-0.5 mr-1 rounded-md bg-primary text-white hover:brightness-90"><span data-feather="eye" class="w-4"></span></a>
          </td>
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