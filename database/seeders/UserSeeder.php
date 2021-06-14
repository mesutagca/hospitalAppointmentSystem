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
use App\Models\MedicineRecipe;
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
        $userA1 = User::factory([
            'name' => 'admin1',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'admin',
        ])->create();


        $userA2 = User::factory([
            'name' => 'admin2',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'admin',
        ])->create();

        $userD1 = User::factory([
            'name' => 'doctor1',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor1@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD2 = User::factory([
            'name' => 'doctor2',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor2@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD3 = User::factory([
            'name' => 'doctor3',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor3@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD4 = User::factory([
            'name' => 'doctor4',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor4@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD5 = User::factory([
            'name' => 'doctor5',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor5@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD6 = User::factory([
            'name' => 'doctor6',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor6@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD7 = User::factory([
            'name' => 'doctor7',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor7@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userD8 = User::factory([
            'name' => 'doctor8',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'doctor8@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'doctor',
        ])->create();

        $userP1 = User::factory([
            'name' => 'patient1',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'patient1@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'patient',
        ])->create();

        $userP2 = User::factory([
            'name' => 'patient2',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'patient2@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'patient',
        ])->create();


        $userP3 = User::factory([
            'name' => 'patient3',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'patient3@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'patient',
        ])->create();

        $userP4 = User::factory([
            'name' => 'patient4',
            'surname' => 'surname',
            'phone' => '5326789632',
            'address' => 'merkez mahallesi',
            'birthday' => '1900-01-01 21.00.45',
            'gender' => 'male',
            'email_verified_at' => '2021-04-29 21:00:45',
            'email' => 'patient4@gmail.com',
            'password' => Hash::make('12345678'),
            'type' => 'patient',
        ])->create();


    }

}
