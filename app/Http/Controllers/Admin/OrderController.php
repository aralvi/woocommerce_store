<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Shop;
use App\Models\AppOrder;
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
use App\Consignment;
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
       
        
        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        if ($settingExist) {
            $shops = Shop::all();
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            $shopDefault = Shop::where('id', $setting->shop_id)->first();
            $orders = AppOrder::where('shop_id', $shopDefault->id)->get();
            $store_url = $shopDefault->store_url;
            $consumer_key = $shopDefault->consumer_key;
            $consumer_secret = $shopDefault->consumer_secret;
            return view('admin.orders.index', compact('orders', 'shops', 'setting', 'store_url', 'consumer_key', 'consumer_secret'));
        }
    }

    public function fetchOrders(Request $request)
    {
        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        $agoDate = \Carbon\Carbon::now()->subDays(7);
        $currentDate = \Carbon\Carbon::today();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            $shopExist = Shop::where('id', $setting->shop_id)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('store_url', $request->store_url)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                $store_url = $shopDefault->store_url;
                $store_url = $shopDefault->store_url;
                $consumer_key = $shopDefault->consumer_key;
                $consumer_secret = $shopDefault->consumer_secret;
                $order_page = AppOrder::where('shop_id', $shopDefault->id)->get()->last();
                // if(isset($order_page)){

                //     $page = $order_page->page +1;
                // }else{
                    $page = 1;
                // }
                $options = [
                    // 'page' => $page,
                    'per_page' => 100 // Or your desire number
                ];
                $fetch_orders = Order::all($options);
                // dd($fetch_orders);
                foreach ($fetch_orders as $fetch_order) {

                    if($fetch_order->date_created >= $agoDate || $fetch_order->date_created <= $currentDate){

                        if (AppOrder::where('id', $fetch_order->id)->doesntExist()) {   
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, Config::get('woocommerce.store_url') . '/wp-json/wc-ast/v3/orders/' . $fetch_order->id . '/shipment-trackings');
                        curl_setopt(
                            $curl,
                            CURLOPT_USERPWD,
                            Config::get('woocommerce.consumer_key') . ":" . Config::get('woocommerce.consumer_secret')
                        );
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json"));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        
                            $app_order = new AppOrder();
                            $app_order->id = $fetch_order->id;
                            $app_order->status = $fetch_order->status;
                            $app_order->customer = $fetch_order->billing->first_name . " " .  $fetch_order->billing->last_name;
                            $app_order->date = $fetch_order->date_created;
                            $app_order->items = count($fetch_order->line_items);
                            $app_order->total = $fetch_order->total;
                            $app_order->shop_id = $shopDefault->id;
                            $app_order->page = $page;
                            $app_order->user_id = Auth::user()->id;
                            if (isset($response)) {
    
                                $data = json_decode($response);
                                if (count($data) > 0){
        
                                    $app_order->tracking_link = $data[0]->tracking_link;
                                }
                            }
                        
                            $app_order->save();
                        }
                    }
                }
                $orders = AppOrder::all();
                return back();
                return view('admin.orders.index', compact('orders', 'shops', 'setting', 'store_url', 'consumer_key', 'consumer_secret'));
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
    public function show(Request $request, $id)
    {
        // dd($request->all());

        if (empty($request->all())) {
            $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
            if ($settingExist) {
                $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', $setting->shop_id)->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', $setting->shop_id)->first();
                    $shops = Shop::all();
                    $store_url =  $shopDefault->store_url;
                    $consumer_key =  $shopDefault->consumer_key;
                    $consumer_secret =  $shopDefault->consumer_secret;
                    Config::set('woocommerce.store_url', $shopDefault->store_url);
                    Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    $orders = Order::find($id);
                    $ordreNotes = Note::all($id);
                    $questions = Question::where('order_id', $id)->get();
                    return view('admin.orders.show', compact('orders', 'ordreNotes', 'store_url', 'consumer_secret', 'consumer_key', 'questions'));
                } else {
                    return view('admin.orders.index')->with('error', 'please configure your store settings!');
                }
            } else {
                return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
            }
        } else {
            $store_url =  $request->store_url;
            $consumer_key = $request->consumer_key;
            $consumer_secret = $request->consumer_secret;
            Config::set('woocommerce.store_url', $request->store_url);
            Config::set('woocommerce.consumer_key', $request->consumer_key);
            Config::set('woocommerce.consumer_secret', $request->consumer_secret);
            $orders = Order::find($id);
            $ordreNotes = Note::all($id);
            $questions = Question::where('order_id', $id)->get();
            return view('admin.orders.show', compact('orders', 'ordreNotes', 'store_url', 'consumer_key', 'consumer_secret', 'questions'));
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
        if ($request->consumer_key == '' && $request->consumer_secret == '') {
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
                    $order = AppOrder::findOrFail($id);
                    $order->status = $request->order_status;
                    $order->save();
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
             Order::update($order_id, $data);
            $order = AppOrder::findOrFail($id);
            $order->status = $request->order_status;
            $order->save();
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
                return ['shops' => $shops, 'setting' => $setting];
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
    public function filter(Request $request)
    {
        $status = $request->status;
        if ($request->key == '' && $request->secret == '' && $request->store_url == '') {
            $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
            if ($settingExist) {
                $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', $setting->shop_id)->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', $setting->shop_id)->first();
                    $shops = Shop::all();
                    // Config::set('woocommerce.store_url', $shopDefault->store_url);
                    // Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    // Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    // dd('fuck');
                    $store_url = $shopDefault->store_url;
                    $key = $shopDefault->consumer_key;
                    $secret = $shopDefault->consumer_secret;
                    if ($status == 'all') {
                        $orders = AppOrder::where('shop_id', $shopDefault->id)->get();
                    } else {
                        $orders = AppOrder::where('status', $status)->where('shop_id', $shopDefault->id)->get();
                    }
                    return view('admin.orders.filter_status', compact('orders', 'store_url', 'key', 'secret'));
                } else {
                    return view('admin.orders.index')->with('error', 'please configure your store settings!');
                }
            } else {
                return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
            }
        } else {
            $store_url = $request->store_url;
            $key = $request->key;
            $secret = $request->secret;
            $shopDefault = Shop::where('store_url', $request->store_url)->first();
            // Config::set('woocommerce.store_url', $store_url);
            // Config::set('woocommerce.consumer_key', $key);
            // Config::set('woocommerce.consumer_secret', $secret);
            if ($status == 'all') {
                $orders = AppOrder::where('shop_id', $shopDefault->id)->get();
            } else {
                $orders = AppOrder::where('status', $status)->where('shop_id', $shopDefault->id)->get();
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
        $shop = Shop::where('consumer_key', $key)->first();
        // Config::set('woocommerce.store_url', $request->store_url);
        // Config::set('woocommerce.consumer_key', $request->key);
        // Config::set('woocommerce.consumer_secret', $request->secret);
        $orders = AppOrder::where('shop_id', $shop->id)->get();
        return view('admin.orders.filter_status', compact('orders', 'store_url', 'key', 'secret'));
    }

    public function changeStatus(Request $request)
    {
        $ids = explode(',', $request->order_list);
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
                    foreach ($ids as $id) {

                        $order_id = $id;
                        $data     = [
                            'status' => $request->order_status,
                        ];
                         Order::update($order_id, $data);
                        $order = AppOrder::findOrFail($id);
                        $order->status = $request->order_status;
                        $order->save();
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
            Config::set('woocommerce.consumer_secret', $request->secret);
            foreach ($ids as $id) {
                
                $order_id = $id;
                $data     = [
                    'status' => $request->order_status,
                ];
                Order::update($order_id, $data);
                $order = AppOrder::findOrFail($id);
                $order->status = $request->order_status;
                $order->save();
            }
            return back()->with('success', 'Order status has been updated');
        }
    }
    public function createTrackingInfo(Request $request)
    {

        if (count($this->userSetting(Auth::user()->id)) > 0) 
        {

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_URL, Config::get('woocommerce.store_url') . '/wp-json/wc-ast/v3/orders/' . $request->order_id . '/shipment-trackings');
            curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key') . ":" . Config::get('woocommerce.consumer_secret'));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json"));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response) {
                $data = json_decode($response);
                if (count($data) == 0) {
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_URL, Config::get('woocommerce.store_url') . '/wp-json/wc-ast/v3/orders/' . $request->order_id . '/shipment-trackings');
                    curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key') . ":" . Config::get('woocommerce.consumer_secret'));
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json"));
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array("tracking_provider" => $request->provider, "tracking_number" => $request->tracking_number, "date_shipped" => date('Y-m-d', strtotime($request->shipping_date)))));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "Create Shipping Error #:" . $err;
                    } else {
                        // $data = json_decode($response);
                        // if(property_exists($data,'data'))
                        // {
                        //     if($data->data->status==404)
                        //     {
                        //         echo $data->message;
                        //         exit;
                        //     }
                        // }

                        // echo "Shipping detail</br>";
                        // echo "Tracking Id : ".$data->tracking_id."</br>";
                        // echo "Tracking Provider : ".$data->tracking_provider."</br>";
                        // echo "Tracking Number : ".$data->tracking_number."</br>";
                        // echo "Shipped Date: ".$data->date_shipped."</br>";
                        $data = json_decode($response);
                        if (property_exists($data, 'data')) {
                            if ($data->data->status == 404) {
                                return back()->with('error', $data->message);
                            }
                        }

                        $order = AppOrder::findOrFail($request->order_id);
                        $order->tracking_link=$data->tracking_link;
                        $order->save();
                        return back()->with('success', 'Tracking Info has been added successfully');
                    }
                } else {
                    return back()->with('warning', 'Tracking info for order id ' . $request->order_id . ' has been already added');
                }
            }


            // $curl=curl_init(); 
            // curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            // curl_setopt($curl,CURLOPT_URL,Config::get('woocommerce.store_url').'/wp-json/wc-ast/v3/orders/'.$id.'/shipment-trackings');
            // curl_setopt($curl, CURLOPT_USERPWD, Config::get('woocommerce.consumer_key').":".Config::get('woocommerce.consumer_secret'));
            // curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json")); 
            // curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode(array("tracking_provider"=>"Fedex","tracking_number"=>123456789012,"date_shipped"=>"2019-03-08"))); 
            // $response = curl_exec($curl);
            // $err = curl_error($curl);
            // curl_close($curl);
            // if ($err) 
            // {
            //     echo "Create Shipping Error #:" . $err;
            // } 
            // else 
            // {
            //     // $data = json_decode($response);
            //     // if(property_exists($data,'data'))
            //     // {
            //     //     if($data->data->status==404)
            //     //     {
            //     //         echo $data->message;
            //     //         exit;
            //     //     }
            //     // }

            //     // echo "Shipping detail</br>";
            //     // echo "Tracking Id : ".$data->tracking_id."</br>";
            //     // echo "Tracking Provider : ".$data->tracking_provider."</br>";
            //     // echo "Tracking Number : ".$data->tracking_number."</br>";
            //     // echo "Shipped Date: ".$data->date_shipped."</br>";
            //     $data = json_decode($response);
            //     if(property_exists($data,'data'))
            //     {
            //         if($data->data->status==404)
            //         {
            //             return back()->with('error', $data->message);
            //         }
            //     }

            //     return back()->with('success', 'Shippment has been created');

            // }
        }
    }

    public function getDetail(Request $request)
    {
        $order = AppOrder::where('id',$request->order_id)->exists();
        if($order){
        // dd($request->all());
        $store_url =  $request->store_url;
        $consumer_key = $request->consumer_key;
        $consumer_secret = $request->consumer_secret;
        $id = $request->order_id;
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->consumer_key);
        Config::set('woocommerce.consumer_secret', $request->consumer_secret);
            $orders = Order::find($id);
            $ordreNotes = Note::all($id);
            $questions = Question::where('order_id', $id)->get();
            return view('admin.orders.show', compact('orders', 'ordreNotes', 'store_url', 'consumer_key', 'consumer_secret', 'questions'));
        }
        else{
            return back()->with('error','no record found');
        }
    }

    public function singleOrderDetail(Request $request)
    {
        if (count($this->userSetting(Auth::user()->id)) > 0) {
            if (Order::find($request->id)) {
                return "exist";
            }
        }
    }

    public function addConsignment($id)
    {
        if (count($this->userSetting(Auth::user()->id)) > 0)
        {
            if(!Consignment::where('order_id',$id)->first())
            {

                $order = Order::find($id);
                $shipping = $order['shipping'];
                $items = [];
                if(count($order['line_items']) > 0)
                {
                    foreach ($order['line_items'] as $key => $value) 
                    {
                        $items[] =array('Reference'=>$value->name,'Weight'=>1,'Quantity'=>$value->quantity,'Packaging'=>1);
                    }
                }

                $array = array("UserID"=>64355,"CompanyName"=>$shipping->company,"Address1"=>'49  Wickliffe Terrace Careys Bay 9023',"Suburb"=>"Careys Bay","Postcode"=>9023,"Items"=>[["Weight"=>1,"Quantity"=>1,"Packaging"=>1]]);
                $curl=curl_init(); 
                curl_setopt($curl,CURLOPT_URL,'https://nz.api.fastway.org/v2/fastlabel/addconsignment?api_key=5392da608c569953e31e450b4a065bba');
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/json")); 
                curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($array));
                $response = curl_exec($curl);
                $error = curl_error($curl);
                curl_close($curl);
                if($response)
                {
                    
                    $data = json_decode($response);
                    if(property_exists($data,'result'))
                    {
                        $consignment = new Consignment();
                        $consignment->store_id=DB::table('shops')->first()->id;
                        $consignment->order_id = $id;
                        $consignment->consignment_id = $data->result->ConsignmentID;
                        $consignment->manifest_id = $data->result->ManifestID;
                        $consignment->label_number = $data->result->LabelNumbers[0];
                        $consignment->lable_color = $data->result->LabelColour;
                        $consignment->rf_code = $data->result->DestinationRFCode;
                        if($consignment->save())
                        {
                            return back()->with('success', 'Consignment has been added successfully');
                        }
                    }
                    else if(property_exists($data,'error')){
                        return back()->with('error', $data->error);
                    }
                    // echo "<pre>";
                    // print_r($data);
                    // die;
                    // print_r($data->result->LabelNumbers[0]);
                }

            }
            else
            {
                return back()->with('warning', 'Consignment for order id ' . $id . ' has been already added');
            }
        }
    }
}
