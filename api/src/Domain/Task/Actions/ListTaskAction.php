<?php

namespace Domain\Task\Actions;

use Domain\Task\Models\Tasks;

class ListTaskAction
{
	public function __construct(
		public Tasks $tasksModel,
	) {
	}

	public function execute(array $data)
	{
        $tasks = $this->tasksModel->with('user');

        if (isset($data['user_id']) && $data['user_id'] !== '') {
          $tasks->whereAssignedTo($data['user_id']);
        }

        if (isset($data['search']) && $data['search'] !== '') {
          $tasks->where('name', 'LIKE', "%{$data['search']}%");
        }
        
        $tasks = $tasks->paginate(5);

		return $tasks;
	}
}