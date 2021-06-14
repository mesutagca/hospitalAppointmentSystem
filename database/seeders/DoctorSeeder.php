<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorDocument;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Doctor::factory([
            'branch_id'=>1,
            'user_id'=>3
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>2,
            'user_id'=>4
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>3,
            'user_id'=>5
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>4,
            'user_id'=>6
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>5,
            'user_id'=>7
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>6,
            'user_id'=>8
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>7,
            'user_id'=>9
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

        Doctor::factory([
            'branch_id'=>8,
            'user_id'=>10
        ])->has(
                DoctorDocument::factory()
                    ->count(1)
            )->create();

    }

}
