<?php

namespace Domain\Auth\Actions;

use App\library\Jwt;

class CheckTokenAction
{
    public function __construct(
        public readonly Jwt $jwt
    ) {}

    public function execute()
    {
        $this->jwt::validate();
    }
}