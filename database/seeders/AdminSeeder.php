<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory([
            'user_id'=>1
        ])->create();


        Admin::factory([
            'user_id'=>2
        ])->create();
    }
}
