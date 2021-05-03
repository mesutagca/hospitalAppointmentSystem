<?php

namespace Database\Factories;

use App\Models\Diagnose;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiagnoseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diagnose::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>'flu',
        ];
    }
}
