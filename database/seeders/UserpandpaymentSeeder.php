<?php

namespace Database\Seeders;

use App\Models\Payments;
use App\Models\Users;
use Illuminate\Database\Seeder;

class UserpandpaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::factory()->times(50)->create();
        Payments::factory()->times(300)->create();
    }
}
