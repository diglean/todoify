<?php

namespace Domain\User\Actions;

use Domain\User\DataTransferObject\CreateUserData;
use Domain\User\Enums\UserType;
use Domain\User\Models\Users;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
	public function __construct(
		public Users $usersModel,
	) {
	}

	public function execute(CreateUserData $data)
	{
		$createdUser = $this->usersModel->create([
			'name' => $data->name,
			'email' => $data->email,
            'birth_date' => $data->birth_date,
			'password' => Hash::make($data->password),
			'profile_picture_url' => 'https://avatars.githubusercontent.com/u/72869261?v=4',
			'type' => UserType::Regular,
		]);

		return [
			'id' => $createdUser->id,
		];
	}
}