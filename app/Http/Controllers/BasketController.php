<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;
use Illuminate\Support\Facades\Auth;
use App\User;
class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $baskets = Basket::where('id_user', $user_id)->paginate(10);
        return view('basket.index', compact('baskets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        //
    }
    public function add($id)
    {
        $any = Basket::where('id_user', Auth::user()->id)->where('id_product', $id)->get();
        if(count($any) == 0){
            $new_basket = new Basket();
            $new_basket->id_user = Auth::user()->id;
            $new_basket->id_product = $id;
            $new_basket->amount = 1;
            $new_basket->save();
        }
        return redirect()->route('baskets.index');
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
        $basket = Basket::find($id);
        $basket->delete();
        return redirect()->route('baskets.index');
    }
}
