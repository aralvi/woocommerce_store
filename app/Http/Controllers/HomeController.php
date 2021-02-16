<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Shop;
use Codexshaper\WooCommerce\Facades\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
                $orders = Order::all();
                $completed_orders = Order::where('status', 'completed')->get();
                $pending_orders = Order::where('status', 'pending')->get();
                $processing_orders = Order::where('status', 'processing')->get();
                $cancelled_orders = Order::where('status', 'cancelled')->get();
                $refunded_orders = Order::where('status', 'refunded')->get();
                $failed_orders = Order::where('status', 'failed')->get();
                return view('home', compact('orders', 'shops', 'setting', 'completed_orders', 'pending_orders', 'processing_orders', 'cancelled_orders', 'refunded_orders', 'failed_orders'));
            } else {
                session()->now('error', 'please configure your store settings!');
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            session()->now('error', 'please configure your default settings for store and order status!');
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
        }
        // return view('home');
    }
}
