<?php

namespace Domain\Task\DataTransferObject;

use Domain\Task\Enums\TaskCategory;
use Domain\Task\Enums\TaskStatus;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;

class UpdateTaskData extends Data
{
	public function __construct(
    public int $id,
		public string $name,
		public string $description,
		public string $overdue_date,
		public string $category,
		public int $user_id,
		public ?int $assigned_to,
		public ?string $status,
	) {
	}

	public static function rules(): array
	{
		return [
      		'id' => ['required', 'integer', 'min:1'],
			'name' => ['required', 'string', 'max:45'],
			'description' => ['required', 'string', 'max:255'],
			'overdue_date' => ['required', 'date_format:Y-m-d H:i'],
			'category' => ['required', new Enum(TaskCategory::class)],
			'user_id' => ['required', 'integer', 'min:1'],
			'assigned_to' => ['nullable', 'integer', 'min:1'],
			'status' => ['nullable', new Enum(TaskStatus::class)],
		];
	}
}