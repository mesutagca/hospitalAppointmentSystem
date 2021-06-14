<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Diagnose;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            BranchSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            DiagnoseSeeder::class,
            MedicineSeeder::class,
            AppointmentSeeder::class,
            MedicineRecipeSeeder::class,


        ]);
    }
}
