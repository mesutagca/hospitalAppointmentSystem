<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $patient1 = Patient::factory([
            'user_id'=>11,
        ])->create();

        $patient2 = Patient::factory([
            'user_id'=>12,
        ])->create();

        $patient3 = Patient::factory([
            'user_id'=>13,
        ])->create();

        $patient4 = Patient::factory([
            'user_id'=>14,
        ])->create();
    }
}
