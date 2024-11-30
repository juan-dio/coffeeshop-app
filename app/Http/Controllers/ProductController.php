<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage.products.index', [
            'page' => 'Manage Menu',
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.products.create', [
            'page' => 'Manage Menu',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validatedData);

        return redirect('/manage/menu')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $menu)
    {
        return view('manage.products.show', [
            'page' => 'Manage Menu',
            'product' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $menu)
    {
        return view('manage.products.edit', [
            'page' => 'Manage Menu',
            'product' => $menu,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $menu)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|file|max:1024'
        ];

        if($request->slug != $menu->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($menu->image) {
                Storage::delete($menu->image);
            }
            $validatedData['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $menu->id)
            ->update($validatedData);

        return redirect('/manage/menu')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $menu)
    {
        if($menu->image) {
            Storage::delete($menu->image);
        }

        Product::destroy($menu->id);

        return redirect('/manage/menu')->with('success', 'Product has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
