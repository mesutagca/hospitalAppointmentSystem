<?php

namespace Database\Factories;

use App\Models\DoctorDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DoctorDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'diploma',
            'path'=>'public/doctors/doctor1/diploma.pdf',
        ];
    }
}
