<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Diagnose;
use App\Models\Doctor;
use App\Models\DoctorDocument;
use App\Models\Folder;
use App\Models\Medicine;
use App\Models\MedicineCompany;
use App\Models\Patient;
use App\Models\PatientDocument;
use App\Models\Recipe;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::factory([
            'name' => 'admin',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'admin',
        ])->create();

        Admin::factory()->count(1)
            ->for($user1)->create();

        $user2 = User::factory([
            'name' => 'patient',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'pation@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'pation',
        ])->create();

        $patient1 = Patient::factory()->count(1)
            ->for($user2)
            ->create();


        $user3 = User::factory([
            'name' => 'doctor',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $doctor1 = Doctor::factory()->count(1)
            ->for($user3)
            ->has(
                Branch::factory()
                    ->count(1)
            )
            ->has(
                DoctorDocument::factory()
                    ->count(1)
            )
            ->create();
        //iki tane for yaparken collection oluyor

        $appointment1 = Appointment::factory([
            'doctor_id' => 1,
            'patient_id' => 1,
        ])->create();

        $diagnose = Diagnose::factory()->create();

        $folder1 = Folder::factory(
            [
                'diagnose_id' => 1
            ]
        )
            ->for($appointment1)
            ->has(Treatment::factory())
            ->has(PatientDocument::factory())
            ->count(1)->create();

        $medicine1 = MedicineCompany::factory()
            ->has(Medicine::factory())
            ->create();

        Recipe::factory(
            [
                'medicine_id'=>1,
                'treatment_id'=>1,
            ]
        );
    }

}