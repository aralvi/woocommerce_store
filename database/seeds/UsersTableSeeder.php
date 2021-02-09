<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Abdur Rehman';
        $user->email = "aralvi143@gmail.com";
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
