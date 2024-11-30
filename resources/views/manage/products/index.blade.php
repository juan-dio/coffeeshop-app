@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container py-8 px-2 md:px-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">Manage Menu</h2>
    </div>
    
    <div class="md:w-3/4">
      <a href="/manage/menu/create" class="flex items-center w-fit mb-2 px-4 py-2 rounded-md text-white bg-green-500 hover:brightness-90"><span data-feather="plus-circle" class="mr-1"></span> Add Product</a>
      @if (session()->has('success'))
        <div class="w-full mb-2" id="alert">
          <div class="flex items-center justify-between bg-green-100 border border-green-600 text-green-600 px-4 py-3 rounded-lg">
            {{ session('success') }}
            <button id="close-alert" onclick="closeAlert()"><i data-feather="x"></i></button>
          </div>
        </div>
      @endif
      <table class="w-full border-collapse bg-white">
        <tr class="border-b border-slate-800 text-slate-800 text-sm font-semibold">
          <th class="text-left p-1">#</th>
          <th class="text-left p-1">Name</th>
          <th class="text-left p-1">Category</th>
          <th class="text-center p-1">Action</th>
        </tr>

        @foreach ($products as $product)  
        <tr class="text-slate-800 text-sm @if($loop->iteration % 2 == 1) bg-slate-300 @endif">
          <td class="p-1">{{ $loop->iteration }}</td>
          <td class="p-1">{{ $product->name }}</td>
          <td class="p-1">{{ $product->category->name }}</td>
          <td class="p-1 flex justify-center">
            <a href="/manage/menu/{{ $product->slug }}" class="px-2 py-0.5 mr-1 rounded-md bg-primary text-white hover:brightness-90"><span data-feather="eye" class="w-4"></span></a>
            <a href="/manage/menu/{{ $product->slug }}/edit" class="px-2 py-0.5 mr-1 rounded-md bg-yellow-500 text-white hover:brightness-90"><span data-feather="edit" class="w-4"></span></a>
            <form action="/manage/menu/{{ $product->slug }}" method="post" class="flex">
              @method('delete')
              @csrf
              <button class="px-2 py-0.5 rounded-md bg-red-500 text-white hover:brightness-90" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" class="w-4"></span></button>
            </form>
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