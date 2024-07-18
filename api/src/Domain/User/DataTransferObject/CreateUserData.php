<?php

namespace Domain\User\DataTransferObject;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
	public function __construct(
		public string $name,
		public string $email,
        public string $birth_date,
		public string $password,
		public string $confirm_password,
	) {
	}

	public static function rules(): array
	{
		return [
			'name' => ['required', 'string', 'max:45'],
			'email' => ['required', 'string', new Email()],
            'birth_date' => ['required', 'date_format:Y-m-d'],
			'password' => ['required', 'string'],
			'confirm_password' => ['required', 'string'],
		];
	}
}
