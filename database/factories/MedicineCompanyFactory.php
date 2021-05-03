<?php

namespace Database\Factories;


use App\Models\MedicineCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicineCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>'eczacıbaşı',
            'address'=>'bagcılar/Istanbul',
        ];
    }
}
