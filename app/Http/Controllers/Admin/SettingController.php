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
        $setting = Setting::where('id',1)->first();
        $shopExists = Shop::where('id',1)->exists();
        if($shopExists){
            $shops = Shop::where('id', 1)->get();
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
        // dd($request->all());
        
            $settingExists = Setting::where('id',1)->exists();
            if($settingExists){
                $setting = Setting::where('id', 1)->first();
            }else{
                $setting = new Setting();
            }
            
            if ($company_logo = $request->file('logo')) {
                $company_logo_original_name = $company_logo->getClientOriginalName();
                $image_changed_name = time() . '_' . str_replace('', '-', '');
                if($setting->logo != null){

                    unlink( 'uploads/logo/' . $setting->logo);
                }
                $destinationPath = 'uploads/logo/'; // upload path
                $company_logo->move($destinationPath, $image_changed_name);
                $setting->logo = $image_changed_name;
            }
        
        $setting->expiry_time = $request->expiry_time;
        
        
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
