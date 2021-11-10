<?php

namespace Modules\Admin\Database\Factories\Rbac;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Admin\Models\Rbac\User;

class UserFactory extends Factory
{
    /**
     * @var User $model
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName(),
            'mobile' => $this->faker->unique()->e164PhoneNumber(),
            'force_pass_reset' => false,
            'remarks' => $this->faker->paragraph,
            'enabled' => 'yes',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
