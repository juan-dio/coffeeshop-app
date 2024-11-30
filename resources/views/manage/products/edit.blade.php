@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container p-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">Edit Product</h2>
    </div>

    <div class="md:w-1/2">
      <form action="/manage/menu/{{ $product->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="flex flex-col mb-2">
          <label for="name" class="text-slate-800 ml-2 @error('name') error-text @enderror">Name</label>
          <input type="text" name="name" id="name"  class="text-slate-800 py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('name') error-border @enderror" autofocus required value="{{ old('name', $product->name) }}">
          @error('name')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="slug" class="text-slate-800 ml-2 @error('slug') error-text @enderror">Slug</label>
          <input type="text" name="slug" id="slug"  class="text-slate-800 bg-transparent py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('slug') error-border @enderror" required value="{{ old('slug', $product->slug) }}">
          @error('slug')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="category" class="text-slate-800 ml-2">Category</label>
          <select name="category_id" id="category"  class="text-slate-800 py-2 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out" required>
            @foreach ($categories as $category)
              @if(old('category_id', $product->category_id) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="flex flex-col mb-2">
          <label for="description" class="text-slate-800 ml-2 @error('description') error-text @enderror">Description</label>
          <input type="text" name="description" id="description"  class="text-slate-800 py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('description') error-border @enderror" required value="{{ old('description', $product->description) }}">
          @error('description')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="price" class="text-slate-800 ml-2 @error('price') error-text @enderror">Price</label>
          <input type="text" name="price" id="price"  class="text-slate-800 py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('price') error-border @enderror" required value="{{ old('price', $product->price) }}">
          @error('price')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="image" class="text-slate-800 ml-2 @error('image') error-text @enderror">Image</label>
          @if ($product->image)
            <img src="{{ asset('storage/' . $product->image ) }}" id="img-preview" class="w-2/3 ml-2 mb-1 block">
          @else
            <img id="img-preview" class="w-2/3 ml-2 mb-1">
          @endif
          <input type="file" name="image" id="image"  class="text-slate-800 bg-white py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('image') error-border @enderror" onchange="previewImage()">
          @error('image')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mt-4">
          <button type="submit" class="flex items-center w-fit px-4 py-2 mr-1 rounded-md bg-yellow-500 text-white hover:brightness-90"><span data-feather="edit" class="w-5 mr-1"></span> Edit Product</button>
        </div>
      </form>
    </div>


  </div>
</main>

<script>
  // generate slug otomatis menggunakan package Eloquent-Sluggable
  const name = document.querySelector('#name');
  const slug = document.querySelector('#slug');

  name.addEventListener('keyup', function() {
    fetch('/manage/menu/checkslug?name=' + name.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('#img-preview');

    imgPreview.style.display = 'block';

    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;
  }
</script>

@endsection