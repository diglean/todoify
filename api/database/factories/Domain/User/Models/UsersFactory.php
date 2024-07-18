<?php

namespace Database\Factories\Domain\User\Models;

use Domain\User\Enums\UserType;
use Domain\User\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsersFactory extends Factory
{
    protected $model = Users::class;
    
    public function definition(): array
    {
        $picture_url_hash = fake()->regexify('/[0-9]{8}/');

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'birth_date' => fake()->date(),
            'password' => Hash::make(1234),
            'profile_picture_url' => "https://avatars.githubusercontent.com/u/$picture_url_hash?v=4",
            'type' => fake()->randomElement(UserType::cases()),
            'created_at' => fake()->datetime(),
            'updated_at' => fake()->datetime(),
        ];
    }
}
