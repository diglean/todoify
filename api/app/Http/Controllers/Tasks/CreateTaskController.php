<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Domain\Task\Actions\CreateTaskAction;
use Domain\Task\DataTransferObject\CreateTaskData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{
  	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		CreateTaskAction $action,
	) {
		$data = CreateTaskData::from($request->toArray());

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}