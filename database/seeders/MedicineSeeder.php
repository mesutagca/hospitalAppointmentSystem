<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\MedicineCompany;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MedicineCompany::factory([
            'name'=>'Eczacıbaşı',
            'address'=>'Bağcılar'
        ])->create();

        MedicineCompany::factory([
            'name'=>'NobelIlaç',
            'address'=>'Esenyurt'
        ])->create();

        MedicineCompany::factory([
            'name'=>'AbdiIlaç',
            'address'=>'Istanbul'
        ])->create();


        $medicine1=Medicine::factory([
            'medicine_company_id'=>1,
            'name'=>'paradol',
            'active_ingredient'=>'paracetamol',
            'barcode'=>'EAN47920992001',
        ])->create();

        $medicine2=Medicine::factory([
            'medicine_company_id'=>1,
            'name'=>'CABASER',
            'active_ingredient'=>'cabergoline',
            'barcode'=>'A8681308011091',
        ])->create();


        $medicine3=Medicine::factory([
            'medicine_company_id'=>1,
            'name'=>'CANEPHRON',
            'active_ingredient'=>'urologicals',
            'barcode'=>'A8680952381918',
        ])->create();

        $medicine4=Medicine::factory([
            'medicine_company_id'=>2,
            'name'=>'CYPLOS',
            'active_ingredient'=>'salmeterol',
            'barcode'=>'A8680833550150',
        ])->create();

        $medicine5=Medicine::factory([
            'medicine_company_id'=>2,
            'name'=>'MESOSEL',
            'active_ingredient'=>'mesalazine',
            'barcode'=>'A8680400771124',
        ])->create();

        $medicine6=Medicine::factory([
            'medicine_company_id'=>2,
            'name'=>'HYQVIA',
            'active_ingredient'=>'immunoglobulins',
            'barcode'=>'A8681429550301',
        ])->create();



        $medicine7=Medicine::factory([
            'medicine_company_id'=>3,
            'name'=>'LUTICASS',
            'active_ingredient'=>'formoterol',
            'barcode'=>'A8699525529749',
        ])->create();

        $medicine8=Medicine::factory([
            'medicine_company_id'=>3,
            'name'=>'PIRALDYNE',
            'active_ingredient'=>'various',
            'barcode'=>'A8699695000017',
        ])->create();

        $medicine9=Medicine::factory([
            'medicine_company_id'=>3,
            'name'=>'TOLTERIDEX',
            'active_ingredient'=>'tolterodine',
            'barcode'=>'A8699541170123',
        ])->create();


    $medicine10=Medicine::factory([
            'medicine_company_id'=>2,
            'name'=>'VILDALIP',
            'active_ingredient'=>'vildagliptin',
            'barcode'=>'A8680881019746',
        ])->create();
    }

}
