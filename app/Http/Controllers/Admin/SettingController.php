<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::where('user_id',Auth::user()->id)->first();
        $shopExists = Shop::where('user_id',Auth::user()->id)->exists();
        if($shopExists){
            $shops = Shop::where('user_id', Auth::user()->id)->get();
            return view('admin.settings.index',compact('setting','shops'));
        }else{
            session()->now('error', 'please configure your store settings first!');
            return view('admin.settings.index');
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
            'store' => 'required',
            'order_status' => 'required',
        ]);
        $settingExists = Setting::where('user_id',Auth::user()->id)->exists();
        if($settingExists){
            $setting = Setting::where('user_id', Auth::user()->id)->first();
        }else{
            $setting = new Setting();
        }
        $setting->user_id = Auth::user()->id;
        $setting->shop_id = $request->store;
        $setting->expiry_time = $request->expiry_time;
        $setting->order_status = $request->order_status;
        $setting->save();
        
        return back()->with('success',"setting has been updated");
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
