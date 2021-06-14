<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineRecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        foreach (Medicine::all() as $medicine){
            $recipes=Recipe::inRandomOrder()->take(rand(1,3))->pluck('id');
            $medicine->recipes()->attach($recipes);

                $medicine->recipes()->attach($recipes);
        }
    }
}
