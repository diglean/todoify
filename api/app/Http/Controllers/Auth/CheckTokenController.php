<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use App\library\Jwt;

class CheckTokenController extends Controller
{
	public function __construct(
		public readonly Response $response,
		public readonly Jwt $jwt
	) {
	}

	public function __invoke() {
		$this->jwt->validate();
	}
}