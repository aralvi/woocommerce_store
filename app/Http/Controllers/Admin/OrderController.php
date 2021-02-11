<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use Codexshaper\WooCommerce\Facades\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
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
        $orders = Order::find($id);
        $products = Product::all();
        // dd($products);
        return view('admin.orders.show',compact('orders','products'));
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
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter($status)
    {       
        if($status == 'all'){
            $orders = Order::all();
        }else{

            $orders = Order::where('status',$status)->get();
        }
        
        return view('admin.orders.filter_status', compact('orders'));
    }

    public function search(Request $request)
    {
        dd($request->all());
        $query = $request->get('query');
        if (isset($query)) {
            $orders = Order::where('id', 'LIKE', "%{$query}%")->get();
            return view('admin.orders.search', compact('orders'));
        } else {
            $orders = Order::all();
            return view('admin.orders.search', compact('orders'));
        }
    }
    public function selectStore(Request $request)
    {
        env('WOOCOMMERCE_STORE_URL', $request->store_url);
        env('WOOCOMMERCE_CONSUMER_KEY', $request->key);
        env('WOOCOMMERCE_CONSUMER_SECRET', $request->secret);
        $orders = Order::all();
        return view('admin.orders.filter_status', compact('orders'));
    }
}
