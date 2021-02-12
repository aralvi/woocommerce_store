<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->user_id = '1';
        $setting->shop_id = '1';
        $setting->order_status = 'processing';
        $setting->save();
    }
}
