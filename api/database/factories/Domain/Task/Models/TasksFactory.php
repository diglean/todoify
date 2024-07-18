<?php

namespace Database\Factories\Domain\Task\Models;

use Domain\Task\Enums\TaskCategory;
use Domain\Task\Enums\TaskStatus;
use Domain\Task\Models\Tasks;
use Domain\User\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksFactory extends Factory
{
	protected $model = Tasks::class;

	public function definition(): array
	{
      $qty_users = Users::count();

		return [
			'name' => fake()->name(),
			'category' => fake()->randomElement(TaskCategory::cases()),
			'description' => fake()->sentence(),
			'assigned_to' => fake()->numberBetween(1, $qty_users),
			'status' => fake()->randomElement(TaskStatus::cases()),
			'created_by' => 1,
			'overdue_date' => fake()->dateTime(),
			'created_at' => fake()->dateTime(),
			'updated_at' => fake()->dateTime(),
		];

	}
}