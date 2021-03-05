<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Carbon\Carbon;
use Codexshaper\WooCommerce\Facades\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrderNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                // $id = $_GET['order_id'];
                $id = 73;
                $ordreNotes = Note::all($id);
                dd($ordreNotes);
                return view('admin.ordernotes.index', compact('ordreNotes'));
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
                $current_time = Carbon::now()->toDateTimeString();
                if($request->note == 'false'){
                    $note_status = false;
                }else{
                    $note_status = true;
                }

                $data = [
                    'note' => $request->order_note . "- Added By:" . Auth::user()->name . '- Time:' . $current_time,
                    'customer_note'=> $note_status,
                ];

                $note = Note::create($request->order_id, $data);
                return back()->with('success', 'Order Note has been created!');
            } else {
                return view('admin.orders.index')->with('error', 'please configure your store settings!');
            }
        } else {
            return view('admin.orders.index')->with('error', 'please configure your default settings for store and order status!');
        }
       

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
    public function destroy(Request $request,$id)
    {
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->key);
        Config::set('woocommerce.consumer_secret', $request->secret);
        $order_id = $request->order_id;
        $note_id = $id;
        $options = ['force' => true]; // Set force option true for delete permanently. Default value false
        $note = Note::delete($order_id, $note_id, $options);
    }
}
