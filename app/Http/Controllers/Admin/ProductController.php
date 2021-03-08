<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppProduct;
use App\Models\Setting;
use App\Models\SettingStore;
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
        // $settingExist = SettingStore::where('shop_id', decrypt($_GET['store']))->exists();
        // if ($settingExist) {
            $setting = SettingStore::where('shop_id', decrypt($_GET['store']))->first();
        //     dd($setting);
            $shopExist = Shop::where('id', decrypt($_GET['store']))->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('id', decrypt($_GET['store']))->first();
                $shops = Shop::all();
                // Config::set('woocommerce.store_url', $shopDefault->store_url);
                // Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                // Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                // $options = [
                //     'per_page' => 100 // Or your desire number
                // ];
                // $products = Product::all($options);
                $products = AppProduct::where('shop_id', decrypt($_GET['store']))->get();
                $store_url = $shopDefault->store_url;
                $consumer_key = $shopDefault->consumer_key;
                $consumer_secret = $shopDefault->consumer_secret;
                return view('admin.products.index', compact('products', 'shops', 'setting', 'store_url', 'consumer_key', 'consumer_secret'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        // } else {
        //     session()->now('error', 'please configure your default settings for store and order status!');
        //     return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        // }
        
    }
    public function fetchProducts(Request $request)
    {
        // dd($request->all());
        // $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        // if ($settingExist) {
                $setting = SettingStore::where('shop_id', decrypt($_GET['store']))->first();
            $shopExist = Shop::where('store_url', $request->store_url)->exists();
            if ($shopExist) {
                $shopDefault = Shop::where('store_url', $request->store_url)->first();
                $shops = Shop::all();
                Config::set('woocommerce.store_url', $shopDefault->store_url);
                Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                $store_url = $shopDefault->store_url;
                $consumer_key = $shopDefault->consumer_key;
                $consumer_secret = $shopDefault->consumer_secret;
                $options = [
                    'per_page' => 100 // Or your desire number
                ];
                $fetch_products = Product::all($options);
                foreach($fetch_products as $fetch_product){
                    if (AppProduct::where('id', $fetch_product->id)->doesntExist()) {   
                    $product = new AppProduct();
                    $product->id = $fetch_product->id;
                    $product->user_id = Auth::user()->id;
                    $product->shop_id = $shopDefault->id;
                    $product->name = $fetch_product->name;
                    $product->slug = $fetch_product->slug;
                    $product->sku = $fetch_product->sku;
                    $product->supplier_sku = $fetch_product->supplier_sku;
                    $product->regular_price = $fetch_product->regular_price;
                    $product->sale_price = $fetch_product->sale_price;
                    $product->manage_stock = $fetch_product->manage_stock;
                    $product->stock_quantity = $fetch_product->stock_quantity;
                    $product->backorders = $fetch_product->backorders;
                    $product->weight = $fetch_product->weight;
                    $product->purchase_note = $fetch_product->purchase_note;
                    $product->catalog_visibility = $fetch_product->catalog_visibility;
                    $product->out_stock_threshold = $fetch_product->out_stock_threshold;
                    $product->stock_status = $fetch_product->stock_status;
                    $product->description = $fetch_product->description;
                    $product->status = $fetch_product->status;
                    $product->category = $fetch_product->categories[0]->name;
                    foreach($fetch_product->images as $img){
                        $product->image = $img->src;
                        break;
                    }
                    foreach($fetch_product->meta_data as $barcode){
                        if($barcode->key == '_ywbc_barcode_display_value'){

                            $product->barcode = $barcode->value;
                            break;
                        }
                    }
                    $product->save();
                }
            }
                $products = AppProduct::where('shop_id',$shopDefault->id)->get();
                return view('admin.products.index', compact('products', 'shops', 'setting' ,'store_url', 'consumer_key', 'consumer_secret'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        // } else {
        //     session()->now('error', 'please configure your default settings for store and order status!');
        //     return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        // }
        
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
    public function show(Request $request,$id)
    {
        // if (empty($request->all())) {
            // $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
            // if ($settingExist) {
                // $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', decrypt($_GET['store']))->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', decrypt($_GET['store']))->first();
                    $shops = Shop::all();
                    $store_url = $shopDefault->store_url;
                    $consumer_key = $shopDefault->consumer_key;
                    $consumer_secret = $shopDefault->consumer_secret;
                    //     Config::set('woocommerce.store_url', $shopDefault->store_url);
                    //     Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    //     Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    $product = AppProduct::findOrFail($id);
                   
                    
                    return view('admin.products.show', compact('product', 'shops', 'store_url', 'consumer_key', 'consumer_secret'));
                } else {
                    return view('admin.products.index')->with('error', 'please configure your store settings!');
                }
            // } else {
            //     return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
            // }
        // } else {
        //     $store_url = $request->store_url;
        //     $consumer_key = $request->consumer_key;
        //     $consumer_secret = $request->consumer_secret;
        //     Config::set('woocommerce.store_url', $request->store_url);
        //     Config::set('woocommerce.consumer_key', $request->consumer_key);
        //     Config::set('woocommerce.consumer_secret', $request->consumer_secret);
        //     $product = Product::find($id);
        //     return view('admin.products.show', compact('product', 'store_url', 'consumer_key', 'consumer_secret'));
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        // if (empty($request->all())) {
        //     $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        //     if ($settingExist) {
                // $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                $shopExist = Shop::where('id', decrypt($_GET['store']))->exists();
                if ($shopExist) {
                    $shopDefault = Shop::where('id', decrypt($_GET['store']))->first();
                    $shops = Shop::all();
                    $store_url = $shopDefault->store_url;
                    $consumer_key = $shopDefault->consumer_key;
                    $consumer_secret = $shopDefault->consumer_secret;
                    Config::set('woocommerce.store_url', $shopDefault->store_url);
                    Config::set('woocommerce.consumer_key', $shopDefault->consumer_key);
                    Config::set('woocommerce.consumer_secret', $shopDefault->consumer_secret);
                    $product = Product::find($id);
                return view('admin.products.edit', compact('product', 'store_url', 'consumer_key', 'consumer_secret'));
            } else {
                return view('admin.products.index')->with('error', 'please configure your store settings!');
            }
        // } else {
        //     return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        // }
        // } else {
        //     $store_url = $request->store_url;
        //     $consumer_key = $request->consumer_key;
        //     $consumer_secret = $request->consumer_secret;
        //     Config::set('woocommerce.store_url', $request->store_url);
        //     Config::set('woocommerce.consumer_key', $request->consumer_key);
        //     Config::set('woocommerce.consumer_secret', $request->consumer_secret);
        //     $product = Product::find($id);
        //     return view('admin.products.edit', compact('product', 'store_url', 'consumer_key', 'consumer_secret'));
        // }
        
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
        // $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        // if ($settingExist) {
        //     $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
        //     $shopExist = Shop::where('id', $setting->shop_id)->exists();
        //     if ($shopExist) {
        //         $shopDefault = Shop::where('id', $setting->shop_id)->first();
        //         $shops = Shop::all();
                Config::set('woocommerce.store_url', $request->store_url);
                Config::set('woocommerce.consumer_key', $request->consumer_key);
                Config::set('woocommerce.consumer_secret', $request->consumer_secret);
                
                if(isset($request->catalog_visibility)){
                    $catalog_visibility = $request->catalog_visibility;
                }else{
                    $catalog_visibility = 'hidden';
                }
                $data       = [
                    'name' => $request->name,
                    'regular_price' => $request->regular_price,
                    'sale_price'    => $request->sale_price, // 50% off
                    'purchase_price'    => $request->purchase_price, // 50% off
                    'sku'    => $request->sku, // 50% off
                    'status'    => $request->product_status, // 50% off
                    'manage_stock'    => $request->manage_stock, // 50% off
                    'stock_quantity'    => $request->stock_quantity, // 50% off
                    'backorders'    => $request->backorders, // 50% off
                    'weight'    => $request->weight, // 50% off
                    'purchase_note'    => $request->purchase_note, // 50% off
                    'catalog_visibility'    => $catalog_visibility, // 50% off
                    'out_stock_threshold'    => $request->out_stock_threshold, // 50% off
                ];

                 Product::update($id, $data);
                $product = AppProduct::findOrFail($id);
                $product->name = $request->name;
                $product->regular_price = $request->regular_price;
                $product->sale_price = $request->sale_price;
                // $product->purchase_price = $request->purchase_price;
                $product->sku = $request->sku;
                $product->status = $request->status;
                if(isset($request->manage_stock)){

                    $product->manage_stock = $request->manage_stock;
                }else{
                    $product->manage_stock =false;
                }
                $product->stock_quantity = $request->stock_quantity;
                $product->backorders = $request->backorders;
                // $product->wieght = $request->wieght;
                // $product->purchase_note = $request->purchase_note;
                $product->catalog_visibility = $request->catalog_visibility;
                // $product->out_stock_threshold = $request->out_stock_threshold;
                $product->save();
                return back()->with('success', 'Product has been updated');
        //     } else {
        //         return view('admin.products.index')->with('error', 'please configure your store settings!');
        //     }
        // } else {
        //     return view('admin.products.index')->with('error', 'please configure your default settings for store and order status!');
        // }
        
                    
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
        $store_url = $request->store_url;
        $key = $request->key;
        $secret = $request->secret;
        Config::set('woocommerce.store_url', $request->store_url);
        Config::set('woocommerce.consumer_key', $request->key);
        Config::set('woocommerce.consumer_secret', $request->secret);
        $options = [
            'per_page' => 100 // Or your desire number
        ];
        $products = Product::all($options);
        return view('admin.products.filter_store', compact('products', 'store_url', 'key', 'secret'));
    }
}
