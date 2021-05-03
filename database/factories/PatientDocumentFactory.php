<?php

namespace Database\Factories;

use App\Models\patientDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = patientDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>'mr',
            'path'=>'public/patients/patient1/mr.pdf',
        ];
    }
}
