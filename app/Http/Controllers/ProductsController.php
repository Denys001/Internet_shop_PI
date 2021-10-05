<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as StorageSup;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products = Product::where('Archive', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.products.index', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('Admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:70|min:6',
            'text' => 'required',
            'image' => 'required',
            'price' => 'required|min:0.1|max:99999.99|numeric'
        ]);
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('text');
        $product->price = $request->input('price');
        $path = $request->file('image')->store('images', 'public');
        $product->image = $path;
        $product->id_category = $request->input('category');
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function show($id, Product $Products)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Product $Products)
    {
        $categories = Category::get();
        $product = Product::where('id', $id)->first();
        return view('admin.products.edite', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Product $Products)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:70|min:6',
            'text' => 'required',
            'price' => 'required|min:0.1|max:99999.99|numeric'
        ]);
        $product = Product::where('id', $id)->first();
        $product->name = $request->input('name');
        $product->description = $request->input('text');
        $product->price = $request->input('price');
        if($request->file('image')){
            $path = $request->file('image')->store('images', 'public');
            StorageSup::delete('public/'.$product->image);
            $product->image = $path;
        } 
        $product->id_category = $request->input('category');
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $Products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $Products)
    {
        $product = Product::where('id', $id)->first();
        StorageSup::delete('public/'.$product->image);
        $product->delete();
        return redirect()->route('products.archive');
    }
    public function archive(){
        $Products = Product::where('Archive', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.products.archive', compact('Products'));
    }
    public function ToArchive($id){
        $product = Product::where('id', $id)->first();
        $product->Archive = true;
        $product->save();
        return redirect()->route('products.archive');
    }
    public function ToUnarchive($id){
        $product = Product::where('id', $id)->first();
        $product->Archive = false;
        $product->save();
        return redirect()->route('products.index');
    }
    public function search(Request $request)
    {
        $text = $request->input('text');
        $Products = Product::Where('name', 'like', $text . '%')->where('Archive', false)->orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.products.index', compact('Products', 'text'));
    }
    public function search_archive(Request $request)
    {
        $text = $request->input('text');
        $Products = Product::Where('name', 'like', $text . '%')->where('Archive', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.products.archive', compact('Products', 'text'));
    }
}
