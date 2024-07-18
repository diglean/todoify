<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Domain\Task\Actions\ListTaskAction;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListTaskController extends Controller
{
  	public function __construct(
		public readonly Response $response,
	) {
	}

	public function __invoke(
		Request $request,
		ListTaskAction $action,
	) {
		$validator = Validator::make(
			data: $request->toArray(),
			rules: [
                'page' => ['nullable', 'integer', 'min:1'],
				'user_id' => ['nullable', 'integer', 'min:1'],
				'search' => ['nullable', 'string', 'max:45'],
			],
		);

    	$data = $validator->validate();

		$response = $action->execute($data);

		return $this->response->json($response, 200);
	}
}