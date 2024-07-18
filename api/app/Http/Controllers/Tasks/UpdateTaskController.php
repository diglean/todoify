<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Domain\Task\Actions\UpdateTaskAction;
use Domain\Task\DataTransferObject\UpdateTaskData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class UpdateTaskController extends Controller
{
  	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		UpdateTaskAction $action,
	) {
		$data = UpdateTaskData::from($request->toArray());

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}