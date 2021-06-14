<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Folder;
use App\Models\PatientDocument;
use App\Models\Recipe;
use App\Models\MedicineRecipe;
use App\Models\Treatment;
use Database\Factories\AppointmentFactory;
use Database\Factories\PatientDocumentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Appointment::factory([
            'doctor_id'=>1,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>1,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
        ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>1,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>2,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>1,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>3,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>1,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>4,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>2,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>5,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>2,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>6,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>2,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>7,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>2,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>8,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>3,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>9,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>3,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>10,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>3,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>11,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>3,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>12,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>4,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>13,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>4,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>14,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>4,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>15,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>4,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>16,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>5,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>1,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>5,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>2,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>5,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>3,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>5,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>4,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>6,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>5,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>6,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>6,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>6,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>7,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>6,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>8,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>7,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>9,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>7,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>10,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>7,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>11,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>7,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>12,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>8,
            'patient_id'=>1
        ])->has(Folder::factory([
            'diagnose_id'=>13,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>8,
            'patient_id'=>2
        ])->has(Folder::factory([
            'diagnose_id'=>14,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>8,
            'patient_id'=>3
        ])->has(Folder::factory([
            'diagnose_id'=>15,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();

        Appointment::factory([
            'doctor_id'=>8,
            'patient_id'=>4
        ])->has(Folder::factory([
            'diagnose_id'=>16,
        ])->has(PatientDocument::factory([
            'name'=>'MR-KanTahlili',
        ]))
            ->has(Treatment::factory()->has(Recipe::factory()))
        )->create();



    }
}
