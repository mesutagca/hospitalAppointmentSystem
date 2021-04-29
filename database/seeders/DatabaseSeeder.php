<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory([
             'name'=>'admin',
             'surname'=>'surname',
             'phone'=>'5326789632',
             'address'=>'merkez mahallesi',
             'birthday'=>'1900-01-01 21.00.45',
             'gender'=>'male',
             'email_verified_at'=>'2021-04-29 21:00:45',
             'email'=>'admin@gmail.com',
             'password'=>'12345678',
         ])->create();
    }
}
