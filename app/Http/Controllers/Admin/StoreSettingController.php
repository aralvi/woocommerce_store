<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_setting = SettingStore::where('shop_id',decrypt($_GET['store']))->get()->first();
        return view('admin.store_settings.index',compact('store_setting'));
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
        $store_settingExists = SettingStore::where('user_id', Auth::user()->id)->where('shop_id', $request->store)->exists();
        if ($store_settingExists) {
            $store_setting = SettingStore::where('user_id', Auth::user()->id)->where('shop_id', $request->store)->first();
        } else {
            $store_setting = new SettingStore();
        }
        $store_setting->user_id = Auth::user()->id;
        $store_setting->shop_id = $request->store;
        $store_setting->order_status = $request->order_status;
        $store_setting->excluded_Status = json_encode($request->excluded_status);
        $store_setting->change_able_status = json_encode($request->change_able_status);
        $store_setting->save();
        return back()->with('success', "setting has been updated"); 
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
    public function destroy($id)
    {
        //
    }
}
