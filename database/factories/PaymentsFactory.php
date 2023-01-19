<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class PaymentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $faker = new Faker();
        $random_status = rand(0, 2);
        return [
            'user_id' => Users::get()->random()->id,
            'amount' => $faker->randomFloat(2, 200.00, 4000.00),
            'status' => ($random_status == 1) ? 'success' : 'failed'
        ];
    }
}
