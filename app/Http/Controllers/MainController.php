<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Category;
use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    public function index(Request $Req)
    {
        if ($Req->filled('price_from') && $Req->filled('price_to')) {

            if ($Req->price_from > $Req->price_to) {
                throw ValidationException::withMessages(['Price max and min' => 'The value of the price to can\'t be greater than the value of the price from']);
            }
        }
        $productsQuery = Product::query();
        $productsQuery->where('Archive', false);
        if ($Req->filled('text')) {
            $productsQuery->where('name', 'like', $Req->text . '%');
        }
        if ($Req->filled('category') && $Req->category != "All") {
            $productsQuery->where('id_category', $Req->category);
        }
        if ($Req->filled('price_from')) {
            $productsQuery->where('price', '>', $Req->price_from);
        }
        if ($Req->filled('price_to')) {
            $productsQuery->where('price', '<', $Req->price_to);
        }
        if ($Req->has('sortBy')) {
            switch ($Req->sortBy) {
                case 'None':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
                case 'Likes':
                    $productsQuery->orderByLikesCount('desc');
                    break;
                case 'Watches':
                    $productsQuery->orderBy('watched', 'desc');
                    break;
                case 'Orders':
                    $productsQuery->orderBy('amount_orders', 'desc');
                    break;
                case 'FromMin':
                    $productsQuery->orderBy('price');
                    break;
                case 'FromMax':
                    $productsQuery->orderBy('price', 'desc');
                    break;
            }
        } else {
            $productsQuery->orderBy('created_at', 'desc');
        }
        $products = $productsQuery->paginate(10);
        $categories = Category::get();
        return view('home', compact('products', 'categories'));
    }
    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }
    public function category($category_name)
    {
        $id_category = Category::where('name', $category_name)->first()->id;
        $products = Product::where('id_category', $id_category)->where('Archive', false)->orderBy('created_at', 'desc')->paginate(10);
        $category = Category::where('name', $category_name)->first();
        return view('category_products', compact('products', 'category'));
    }
    public function product($id, Request $req)
    {
        $product = Product::find($id);
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if (!$pageWasRefreshed && url()->previous() != route('product', $product->id)) {
            $product->watched++;
            $product->save();
        }
        return view('show', compact('product'));
    }
    public function product_like($id, Request $req)
    {
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);
        $product->likeToggle($user->id);
        return redirect()->route('product', $id);
    }
    public function product_dislike($id, Request $req)
    {
        $user = User::find(Auth::user()->id);
        $product = Product::find($id);
        $product->dislikeToggle($user->id);
        return redirect()->route('product', $id);
    }
    public function createorder($id)
    {
        $product = Product::find($id);
        return view('orders.create', compact('product'));
    }
    public function storeorder(Request $req, $id)
    {
        $basket = Basket::where('id_user', Auth::user()->id)->where('id_product', $id)->first();

        if ($basket) {
            $basket->delete();
        }
        $product = Product::find($id);
        $product->amount_orders += $req->input('amount');
        $product->save();
        $order = new Order();
        $order->id_product = $id;
        $order->id_user = Auth::user()->id;
        $order->phone_number = $req->input('phone');
        $order->address = $req->input('address');
        $order->amount = $req->input('amount');
        $order->save();
        return redirect()->route('main.index');
    }
    public function indexorder()
    {
        $waitings = Order::where('id_user', Auth::user()->id)->where('status', 'waiting')->get();
        $processings = Order::where('id_user', Auth::user()->id)->where('status', 'processing')->get();
        $dones = Order::where('id_user', Auth::user()->id)->where('status', 'done')->get();
        return view('orders.index', compact('dones', 'waitings', 'processings'));
    }
    public function buyAll()
    {
        $user_id = Auth::user()->id;
        $baskets = Basket::where('id_user', $user_id)->get();
        return view('orders.buyAll', compact('baskets'));
    }
    public function storeBuyAll(Request $req)
    {
        $user_id = Auth::user()->id;
        $baskets = Basket::where('id_user', $user_id)->get();
        foreach ($baskets as $basket) {
            $product = Product::find($basket->Product()->id);
            $amount = $req['amount' . $basket->id];
            $product->amount_orders += $amount;
            $product->save();
            $order = new Order();
            $order->id_product = $basket->Product()->id;
            $order->id_user = Auth::user()->id;
            $order->phone_number = $req->input('phone');
            $order->address = $req->input('address');
            $order->amount = $amount;
            $order->save();
            $basket->delete();
        }
        return redirect()->route('main.index');
    }
}
