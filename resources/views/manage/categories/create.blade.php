@extends('manage.layouts.main')

@section('container')

<main>
  <div class="container p-8">
    <div class="w-full mb-6">
      <h2 class="text-3xl font-semibold text-slate-800">Add Category</h2>
    </div>

    <div class="md:w-1/2">
      <form action="/manage/categories" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col mb-2">
          <label for="name" class="text-slate-800 ml-2 @error('name') error-text @enderror">Name</label>
          <input type="text" name="name" id="name"  class="text-slate-800 py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('name') error-border @enderror" autofocus required value="{{ old('name') }}">
          @error('name')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="slug" class="text-slate-800 ml-2 @error('slug') error-text @enderror">Slug</label>
          <input type="text" name="slug" id="slug"  class="text-slate-800 bg-transparent py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('slug') error-border @enderror" required readonly value="{{ old('slug') }}">
          @error('slug')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mb-2">
          <label for="image" class="text-slate-800 ml-2 @error('image') error-text @enderror">Image</label>
          <img id="img-preview" class="w-2/3 ml-2 mb-1">
          <input type="file" name="image" id="image"  class="text-slate-800 bg-white py-1 px-2 border border-slate-500 rounded-md focus:outline-none focus:border-slate-800 transition duration-200 ease-in-out @error('image') error-border @enderror" required onchange="previewImage()">
          @error('image')
            <div class="text-sm text-red-600 ml-2">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="flex flex-col mt-4">
          <button type="submit" class="flex items-center w-fit mb-2 px-4 py-2 rounded-md text-white bg-green-500 hover:brightness-90"><span data-feather="plus-circle" class="mr-1"></span> Add Category</button>
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
    fetch('/manage/categories/checkslug?name=' + name.value)
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