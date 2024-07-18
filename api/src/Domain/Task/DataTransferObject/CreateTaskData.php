<?php

namespace Domain\Task\DataTransferObject;

use Domain\Task\Enums\TaskCategory;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;

class CreateTaskData extends Data
{
	public function __construct(
		public string $name,
		public string $description,
		public string $overdue_date,
		public string $category,
		public int $user_id,
		public ?int $assigned_to,
	) {
	}

	public static function rules(): array
	{
		return [
			'name' => ['required', 'string', 'max:45'],
			'description' => ['required', 'string', 'max:255'],
			'overdue_date' => ['required', 'date_format:Y-m-d H:i'],
			'category' => ['required', new Enum(TaskCategory::class)],
			'assigned_to' => ['nullable', 'integer', 'min:1'],
			'user_id' => ['required', 'integer', 'min:1'],
		];
	}
}