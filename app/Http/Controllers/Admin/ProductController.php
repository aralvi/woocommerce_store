<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
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
                $products = Product::all();
                return view('admin.products.index', compact('products', 'shops', 'setting'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        } else {
            session()->now('error', 'please configure your default settings for store and order status!');
            return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
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
                $product = Product::find($id);
                return view('admin.products.show', compact('product', 'shops', 'setting'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
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
                $product = Product::find($id);
                return view('admin.products.edit', compact('product'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        }
        
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
                $data       = [
                    'name' => $request->name,
                    'regular_price' => $request->regular_price,
                    'sale_price'    => $request->sale_price, // 50% off
                ];

                $product = Product::update($id, $data);
                return back()->with('success', 'Product has been updated');
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
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
                $options = ['force' => true]; // Set force option true for delete permanently. Default value false

                $product = Product::delete($id, $options);
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        }
        
    }

    public function selectStore(Request $request)
    {
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->key);
        Config::set('woocommerce.consumer_secret', $request->secret);
        $products = Product::all();
        return view('admin.products.filter_store', compact('products'));
    }
}
