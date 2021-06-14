<?php

namespace Database\Seeders;

use App\Models\Diagnose;
use Illuminate\Database\Seeder;

class DiagnoseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diagnose::factory([
            'name'=>'Alerji',
        ])->create();

        Diagnose::factory([
            'name'=>'Astigmatlık',
        ])->create();

        Diagnose::factory([
            'name'=>'Boğaz iltihabı',
        ])->create();

        Diagnose::factory([
            'name'=>'Cüzzam',
        ])->create();

        Diagnose::factory([
            'name'=>'Diyabet',
        ])->create();

        Diagnose::factory([
            'name'=>'Guatr',
        ])->create();

        Diagnose::factory([
            'name'=>'Hipotiroidi',
        ])->create();

        Diagnose::factory([
            'name'=>'İsteri',
        ])->create();

        Diagnose::factory([
            'name'=>'Kekemelik',
        ])->create();

        Diagnose::factory([
            'name'=>'Kulak ağrısı',
        ])->create();

        Diagnose::factory([
            'name'=>'Kurdeşen',
        ])->create();
        Diagnose::factory([
            'name'=>'Lumbago',
        ])->create();
        Diagnose::factory([
            'name'=>'Migren',
        ])->create();
        Diagnose::factory([
            'name'=>'Parkinasan',
        ])->create();
        Diagnose::factory([
            'name'=>'Raşitizm',
        ])->create();
        Diagnose::factory([
            'name'=>'Sıraca',
        ])->create();

    }
}
