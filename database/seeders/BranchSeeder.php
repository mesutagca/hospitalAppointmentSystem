<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::factory([
            'name'=>'cocuk'
        ])->create();

        Branch::factory([
            'name'=>'Cildiye'
        ])->create();

        Branch::factory([
            'name'=>'Dahiliye'
        ])->create();

        Branch::factory([
            'name'=>'Dis'
        ])->create();

        Branch::factory([
            'name'=>'Fizyoloji'
        ])->create();

        Branch::factory([
            'name'=>'Goz'
        ])->create();

        Branch::factory([
            'name'=>'Kbb'
        ])->create();

        Branch::factory([
            'name'=>'Psychiatry'
        ])->create();
    }
}
