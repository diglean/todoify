<?php

namespace Database\Seeders;

use Domain\Task\Models\Tasks;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
	public function run(): void
	{
		Tasks::factory()->count(100)->create();
	}
}