<?php

namespace Domain\Task\Actions;

use Domain\Task\DataTransferObject\UpdateTaskData;
use Domain\Task\Models\Tasks;
use Domain\User\Enums\UserType;
use Domain\User\Models\Users;

class UpdateTaskAction
{
	public function __construct(
		public Tasks $tasksModel,
		public Users $usersModel,
	) {
	}

	public function execute(UpdateTaskData $data)
	{
		if ($this->isAdmin($data->user_id)) {
            $values = [
              'name' => $data->name,
              'description' => $data->description,
              'overdue_date' => $data->overdue_date,
              'category' => $data->category,
              'assigned_to' => $data->assigned_to,
            ];

            if ($data->status) {
              $values['status'] = $data->status;
            }

			$this->tasksModel
				->whereId($data->id)
				->update($values);
		} else {
			$this->tasksModel
				->whereId($data->id)
				->update(['status' => $data->status]);
		}

		$task = $this->tasksModel->find($data->id);

		return ['task' => $task];
	}

	private function isAdmin(int $user_id): bool
	{
		return $this->usersModel->find($user_id)->type === UserType::Admin;
	}
}