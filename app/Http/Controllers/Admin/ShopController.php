<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        $settingExist = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
        if ($settingExist) {
            $setting = Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
            return view('admin.stores.index',compact('shops','setting'));
        }else{

            return view('admin.stores.index',compact('shops'));
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
        $this->validate($request, [
            'name' => 'required',
            'key' => 'required',
            'secret' => 'required',
            'url' => 'required',
        ]);
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->consumer_key = $request->key;
        $shop->consumer_secret = $request->secret;
        $shop->store_url = $request->url;
        $shop->user_id = Auth::user()->id;
        $shop->save();
        return back()->with('success','Store has been created!');

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
        $shop = Shop::findOrFail($id);
        
        return view('admin.stores.edit',compact('shop'));
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
        $this->validate($request, [
            'name' => 'required',
            'key' => 'required',
            'secret' => 'required',
            'url' => 'required',
        ]);
        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->consumer_key = $request->key;
        $shop->consumer_secret = $request->secret;
        $shop->store_url = $request->url;
        $shop->user_id = Auth::user()->id;
        $shop->save();
        return back()->with('success', 'Store has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();
        
    }
}
