<?php

namespace Domain\Task\Actions;

use Domain\Task\DataTransferObject\CreateTaskData;
use Domain\Task\Enums\TaskStatus;
use Domain\Task\Models\Tasks;

class CreateTaskAction
{
	public function __construct(
		public Tasks $tasksModel,
	) {
	}

	public function execute(CreateTaskData $data)
	{
		$createdTask = $this->tasksModel->create([
			'name' => $data->name,
			'description' => $data->description,
			'overdue_date' => $data->overdue_date,
			'category' => $data->category,
			'assigned_to' => $data->assigned_to,
			'created_by' => $data->user_id,
			'status' => TaskStatus::Pending,
		]);

		return [
			'task' => $createdTask,
		];
	}
}