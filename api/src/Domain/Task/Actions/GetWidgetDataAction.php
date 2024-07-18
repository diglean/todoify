<?php

namespace Domain\Task\Actions;

use Domain\Task\Enums\TaskStatus;
use Domain\Task\Models\Tasks;
use Domain\User\Enums\UserType;
use Domain\User\Models\Users;

class GetWidgetDataAction
{
  public function __construct(
		public Users $usersModel,
		public Tasks $tasksModel,
	) {
	}

	public function execute(array $data)
	{
		$user_id = $data['user_id'];

		$doneTasks = $this->tasksModel
			->whereAssignedTo($user_id)
			->whereStatus(TaskStatus::Done)
			->count();

		if ($this->getUserType($user_id) === UserType::Admin) {
			$assignedTasks = $this->tasksModel
				->whereCreatedBy($user_id)
				->count();
		}

		$pendingTasks = $this->tasksModel
			->whereAssignedTo($user_id)
			->whereStatus(TaskStatus::Pending)
			->count();

		$doingTasks = $this->tasksModel
			->whereAssignedTo($user_id)
			->whereStatus(TaskStatus::Doing)
			->count();

		$overdueTasks = $this->tasksModel
			->whereAssignedTo($user_id)
			->whereStatus(TaskStatus::Overdue)
			->count();

		return [
			'doneTasks' => $doneTasks,
			'pendingTasks' => $pendingTasks,
			'assignedTasks' => $assignedTasks ?? 0,
			'doingTasks' => $doingTasks,
			'overdueTasks' => $overdueTasks,
		];
	}

	private function getUserType(int $user_id): UserType
	{
		return $this->usersModel->find($user_id)->type;
	}
}