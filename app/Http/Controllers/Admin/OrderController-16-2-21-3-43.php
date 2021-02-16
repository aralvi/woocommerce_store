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
                $orders = Order::all();
                return view('admin.orders.index', compact('orders', 'shops', 'setting'));
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
                $orders = Order::find($id);
                $products = Product::all();
                $ordreNotes = Note::all($id);
                return view('admin.orders.show', compact('orders', 'products', 'ordreNotes'));
            } else {
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
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

    // user store setting
    private function userSetting($id)
    {
        $settingExist = Setting::where('user_id', $id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', $id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                return ['shops'=>$shops,'setting'=>$setting];
            }
        }
        return [];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter($status)
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
                if ($status == 'all') {
                    $orders = Order::all();
                } else {
                    $orders = Order::where('status', $status)->get();
                }
                return view('admin.orders.filter_status', compact('orders'));
            } else {
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
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
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->key);
        Config::set('woocommerce.consumer_secret', $request->secret);
        $orders = Order::all();
        return view('admin.orders.filter_status', compact('orders'));
    }

    public function createShipping($id)
    {
        if(count($this->userSetting(Auth::user()->id)) > 0)
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/'.$id.'/shipment-trackings');
            curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key').":".Config::get('woocommerce.consumer_secret'));
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json")); 
            curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode(array("tracking_provider"=>"Fedex","tracking_number"=>"12345678","date_shipped"=>"2019-03-08"))); 
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                echo "Create Shipping Error #:" . $err;
            } 
            else 
            {
                $data = json_decode($response);
                if(property_exists($data,'data'))
                {
                    if($data->data->status==404)
                    {
                        echo $data->message;
                        exit;
                    }
                }

                echo "Shipping detail</br>";
                echo "Tracking Id : ".$data->tracking_id."</br>";
                echo "Tracking Provider : ".$data->tracking_provider."</br>";
                echo "Tracking Number : ".$data->tracking_number."</br>";
                echo "Shipped Date: ".$data->date_shipped."</br>";
                
            }
        }        
    }

    public function getShipping($id)
    {
        if(count($this->userSetting(Auth::user()->id)) > 0)
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/'.$id.'/shipment-trackings');
            curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key').":".Config::get('woocommerce.consumer_secret'));
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json")); 
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                echo "cURL Error #:" . $err;
            } 
            else 
            {
                $data = json_decode($response);
                if(count($data) >0)
                {
                    echo "Get the shipping detail </br>";
                    foreach ($data as $value)
                    {
                        echo "Tracking Id : ".$value->tracking_id."</br>";
                        echo "Tracking Provider : ".$value->tracking_provider."</br>";
                        echo "Tracking Number : ".$value->tracking_number."</br>";
                        echo "Shipped Date: ".$value->date_shipped."</br></br>";
                    }
                }
                else
                {
                    echo "No Shipment record Found";
                }
                
                // print_r($data);
                // // print_r($data[0]->tracking_id);
                // die;
                
            }
        }        
    }

    public function deleteShipping($id,$token)
    {
        if(count($this->userSetting(Auth::user()->id)) > 0)
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/'.$id.'/shipment-trackings/'.$token);
            curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key').":".Config::get('woocommerce.consumer_secret'));
            curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'Delete');
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) 
            {
                echo "cURL Error #:" . $err;
            } 
            else 
            {

                $data = json_decode($response);
                if(property_exists($data,'data'))
                {
                    if($data->data->status==404)
                    {
                        echo $data->message;
                        exit;
                    }
                }
                echo "Get the delete shipping detail </br>";
                echo "Tracking Id : ".$data->tracking_id."</br>";
                echo "Tracking Provider : ".$data->tracking_provider."</br>";
                echo "Tracking Number : ".$data->tracking_number."</br>";
                echo "Shipped Date: ".$data->date_shipped."</br>";
            }
        }        
    }
}
