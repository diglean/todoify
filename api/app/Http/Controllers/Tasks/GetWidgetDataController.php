<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Domain\Task\Actions\GetWidgetDataAction;
use Domain\Task\Actions\UpdateTaskAction;
use Domain\Task\DataTransferObject\UpdateTaskData;
use Illuminate\Contracts\Routing\ResponseFactory as Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GetWidgetDataController extends Controller
{
  	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		GetWidgetDataAction $action,
	) {
    $validator = Validator::make(
      data: $request->toArray(),
      rules: [
        'user_id' => ['required', 'integer', 'min:1'],
      ],
    );

    $data = $validator->validate();

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}