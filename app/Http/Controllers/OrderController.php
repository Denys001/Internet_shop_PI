<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waitings = Order::where('status', 'waiting')->get();
        $processings = Order::where('status', 'processing')->get();
        return view('admin.orders.index', compact('waitings', 'processings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }
    public function process($id)
    {
        $order = Order::find($id);
        $order->status = 'processing';
        $order->save();
        return redirect()->route('orders.index');
    }
    public function done($id)
    {
        $order = Order::find($id);
        $order->status = 'done';
        $order->save();
        return redirect()->route('orders.archive');
    }
    public function archive(Request $req)
    {
        if($req->has('text')){
            $dones_ = DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.id_product')
            ->select('orders.*', 'products.name', 'products.image', 'products.price')
            ->where('name', 'like', $req->input('text') . '%')
            ->where('status', 'done')
            ->get();
            $dones = array();
            foreach($dones_ as $done){
                array_push($dones, Order::find($done->id));
            }
        }
        else{
            $dones = Order::where('status', 'done')->get();
        }
        
        return view('admin.orders.archive', compact('dones'));
    }
}
