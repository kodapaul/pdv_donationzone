<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsersFactory extends Factory
{
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $full_name = $this->faker->firstName() . ' ' . $this->faker->lastName();
        return [
            'full_name' => $full_name,
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('sample'), // password
        ];
    }
}
