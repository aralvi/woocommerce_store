<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop = new Shop();
        $shop->name = 'My Store';
        $shop->consumer_key = 'ck_cefebea7f6e1723f7fb2f8ff9ebf782de0d2a9b6';
        $shop->consumer_secret = 'cs_5fca325692b721e7879eefe0424a7ab3bfcdbd82';
        $shop->store_url = 'https://ewdtech.com/woocommerce_store';
        $shop->user_id = '1';
        $shop->save();
        $shop = new Shop();
        $shop->name = 'ND Staging';
        $shop->consumer_key = 'ck_a14f3a3d8327bff7ed2e108c6683f7f118df768b';
        $shop->consumer_secret = 'cs_7a8e118ac098c940f8bde8dd134f1d39ff73f257';
        $shop->store_url = 'https://staging.nappies.co.nz';
        $shop->user_id = '1';
        $shop->save();
    }
}
