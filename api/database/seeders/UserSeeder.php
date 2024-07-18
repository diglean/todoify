<?php

namespace Database\Seeders;

use Domain\User\Models\Users;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::factory()->count(100)->create();
    }
}
