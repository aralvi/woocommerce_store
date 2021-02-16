<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\Order;
use Codexshaper\WooCommerce\Facades\Product;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\WooCommerceApi;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrderControllerBKp extends Controller
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
        $settingExist = Setting::where('user_id', Auth::user()->id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', $setting->shop_id)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
            }
        }
        $orders = Order::find($id);
        $products = Product::all();
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
        $this->userSetting(Auth::user()->id);
        $order_id = $id;
        $data     = [
            'status' => $request->order_status ,
        ];

        $order = Order::update($order_id, $data);
       

        return back()->with('success', 'Order status has been updated');
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
        $this->userSetting(Auth::user()->id);

        if ($status == 'all') {
            $orders = Order::all();
        } else {
            $orders = Order::where('status', $status)->get();
        }
        return view('admin.orders.filter_status', compact('orders'));
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

    public function getResponse()
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.fastway.org/v2/psc/lookup/AUK/Elsthorpe/4110/5?api_key=e8f36b2fcdb001e040d2702e6fcd3ee1");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        echo($output);
    
        // $url = 'https://sandbox-api.postmen.com/v3/rates';
        // $method = 'POST';
        // $headers = array(
        //     "content-type: application/json",
        //     "postmen-api-key: 8fc7966b-679b-4a57-911d-c5a663229c9e"
        // );
        // $body = '{"shipper_accounts":[{"id":"00000000-0000-0000-0000-000000000000"}],"is_document":false,"shipment":{"parcels":[{"description":"Food XS","box_type":"custom","weight":{"value":2,"unit":"kg"},"dimension":{"width":20,"height":40,"depth":40,"unit":"cm"},"items":[{"description":"Food Bar","origin_country":"USA","quantity":2,"price":{"amount":3,"currency":"HKD"},"weight":{"value":0.6,"unit":"kg"},"sku":"Epic_Food_Bar","hs_code":"1234.12"}]}],"ship_from":{"contact_name":"Sender","phone":"1234 5678","email":"sender@sender.com","street1":"sender street1","street2":"sender street2","street3":"sender street3","city":"Sydney","country":"AUS","postal_code":"2155","type":"residential"},"ship_to":{"contact_name":"Receiver","phone":"9876 5432","email":"receiver@receiver.com","street1":"receiver street1","street2":"receiver street2","street3":"receiver street3","city":"Melbourne","country":"AUS","postal_code":"3001","type":"residential"}},"async":false}';
    
        // $curl = curl_init();
    
        // curl_setopt_array($curl, array(
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_URL => $url,
        //     CURLOPT_CUSTOMREQUEST => $method,
        //     CURLOPT_HTTPHEADER => $headers,
        //     CURLOPT_POSTFIELDS => $body
        // ));
    
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
    
        // curl_close($curl);
    
        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
    }

    public function createShipping()
    {
        if($this->userSetting(Auth::user()->id))
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/117/shipment-trackings');
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
                echo "Tracking Id : ".$data->tracking_id."</br>";
                echo "Tracking Provider : ".$data->tracking_provider."</br>";
                echo "Tracking Number : ".$data->tracking_number."</br>";
                echo "Shipped Date: ".$data->date_shipped."</br>";
            }
        }        
    }

    public function getShipping()
    {
        if($this->userSetting(Auth::user()->id))
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/117/shipment-trackings');
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
                print_r($data[0]->tracking_id);
                die;
                echo "Get the shipping detail </br>";
                echo "Tracking Id : ".$data->tracking_id."</br>";
                echo "Tracking Provider : ".$data->tracking_provider."</br>";
                echo "Tracking Number : ".$data->tracking_number."</br>";
                echo "Shipped Date: ".$data->date_shipped."</br>";
            }
        }        
    }

    public function deleteShipping()
    {
        if($this->userSetting(Auth::user()->id))
        {
            $curl=curl_init(); 
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/117/shipment-trackings');
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
                print_r($data);
                die;
                echo "Get the delete shipping detail </br>";
                echo "Tracking Id : ".$data->tracking_id."</br>";
                echo "Tracking Provider : ".$data->tracking_provider."</br>";
                echo "Tracking Number : ".$data->tracking_number."</br>";
                echo "Shipped Date: ".$data->date_shipped."</br>";
            }
        }        
    }
}
