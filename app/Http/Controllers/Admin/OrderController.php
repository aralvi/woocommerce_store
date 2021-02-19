<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Codexshaper\WooCommerce\Facades\Note;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\WooCommerceApi;
use Illuminate\Contracts\Session\Session;
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
        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                $store_url=$shopDefault->store_url;
                $options = [
                    'per_page' => 100 // Or your desire number
                ];
                $orders = Order::all($options);
                return view('admin.orders.index', compact('orders', 'shops', 'setting', 'store_url'));
            } else {
                session()->now('error', 'please configure your store settings!');
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            session()->now('error', 'please configure your default settings for store and order status!');
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // dd($request->all());
        
        if(empty($request->all()) ){
            $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
            if ($settingExist) {
                $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', $setting->shop_id)->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', $setting->shop_id)->first();
                    $shops = Shop::all();
                    $store_url =  $shopDefault->store_url;
                    Config::set('woocommerce.store_url', $shopDefault->store_url);
                    Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    $orders = Order::find($id);
                    $ordreNotes = Note::all($id);
                    return view('admin.orders.show', compact('orders', 'ordreNotes', 'store_url'));
                } else {
                    return view('admin.orders.index')->with('error', 'please configure your store settings!');
                }
            } else {
                return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
            }
                   
               
        }else{
            $store_url =  $request->store_url;
            $consumer_key = $request->consumer_key;
            $secret = $request->consumer_secret;
            Config::set('woocommerce.store_url', $request->store_url);
            Config::set('woocommerce.consumer_key', $request->consumer_key);
            Config::set('woocommerce.consumer_secret', $request->consumer_secret);
            $orders = Order::find($id);
            $ordreNotes = Note::all($id);
            return view('admin.orders.show', compact('orders', 'ordreNotes', 'store_url', 'consumer_key', 'secret'));
        }
        
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
        // dd($request->all());
        if ($request->consumer_key == '' && $request->consumer_secret == '' ) {
        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                $order_id = $id;
                $data     = [
                        'status' => $request->order_status,
                    ];
                $order = Order::update($order_id, $data);
                return back()->with('success', 'Order status has been updated');
            } else {
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
        }
        } else {
            $store_url = $request->store_url;
            $key = $request->consumer_key;
            $secret = $request->consumer_secret;
            Config::set('woocommerce.store_url', $store_url);
            Config::set('woocommerce.consumer_key', $key);
            Config::set('woocommerce.consumer_secret', $secret);
            $order_id = $id;
            $data     = [
                'status' => $request->order_status,
            ];
            $order = Order::update($order_id, $data);
            return back()->with('success', 'Order status has been updated');
        }

        
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
    public function filter(Request $request)
    {
        $status = $request->status;
        if($request->key == '' && $request->secret == '' && $request->store_url == ''){
            $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
            if ($settingExist) {
                $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', $setting->shop_id)->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', $setting->shop_id)->first();
                    $shops = Shop::all();
                    Config::set('woocommerce.store_url', $shopDefault->store_url);
                    Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    // dd('fuck');
                    $store_url = $shopDefault->store_url;
                    $key = $shopDefault->consumer_key;
                    $secret = $shopDefault->consumer_secret;
                    if ($status == 'all') {
                        $orders = Order::all();
                    } else {
                        $orders = Order::where('status', $status)->get();
                    }
                    return view('admin.orders.filter_status', compact('orders', 'store_url', 'key', 'secret'));
                } else {
                    return view('admin.orders.index')->with('error', 'please configure your store settings!');
                }
            } else {
                return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
            }

        }
        else{
            $store_url = $request->store_url;
            $key = $request->key;
            $secret = $request->secret;
            Config::set('woocommerce.store_url', $store_url);
            Config::set('woocommerce.consumer_key', $key);
            Config::set('woocommerce.consumer_secret', $secret);
            if ($status == 'all') {
                $orders = Order::all();
            } else {
                $orders = Order::where('status', $status)->get();
            }
            return view('admin.orders.filter_status', compact('orders', 'store_url', 'key', 'secret'));
        }
        
    }

    public function search(Request $request)
    {
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
        $store_url = $request->store_url;
        $key = $request->key;
        $secret = $request->secret;
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->key);
        Config::set('woocommerce.consumer_secret', $request->secret);
        $orders = Order::all();
        return view('admin.orders.filter_status', compact('orders','store_url','key','secret'));
    }

    public function changeStatus(Request $request)
    {
        $ids = explode(',',$request->order_list);
        if ($request->key == 'undefined' && $request->secret == 'undefined' && $request->store_url == 'undefined') {

        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                foreach($ids as $id){

                    $order_id = $id;
                    $data     = [
                        'status' => $request->order_status,
                    ];
                    $order = Order::update($order_id, $data);
                }
                return back()->with('success', 'Order status has been updated');
            } else {
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
        }
        }
        else{
            
            Config::set('woocommerce.store_url', $request->store_url);
            Config::set('woocommerce.consumer_key', $request->key);
            Config::set('woocommerce.consumer_secret',$request->secret);
            foreach ($ids as $id) {

                $order_id = $id;
                $data     = [
                    'status' => $request->order_status,
                ];
                $order = Order::update($order_id, $data);
            }
            return back()->with('success', 'Order status has been updated');
        }
    }
}
