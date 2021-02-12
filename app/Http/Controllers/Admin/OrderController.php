<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settingExist = Setting::where('user_id', Auth::user()->id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->first();
            $shopExist = Shop::where('id',$setting->shop_id)->exists();
            if($shopExist){
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                

                $orders = Order::all();
                return view('admin.orders.index', compact('orders', 'shops', 'setting'));
            }
            else{

                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
        }
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
        return view('admin.orders.show', compact('orders', 'products'));
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
        if ($status == 'all') {
            $orders = Order::all();
        } else {

            $orders = Order::where('status', $status)->get();
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
