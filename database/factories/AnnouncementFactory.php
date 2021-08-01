<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = $data['user_id'] ?? User::factory()->create();
        $startDate = now()->addHours(rand(0, 24));
        $endDate = $startDate->copy()->addHours(rand(20, 140));

        return [
            'user_id'   => $user_id,
            'title'     => $this->faker->sentence,
            'content'   => $this->faker->paragraph,
            'active'    => rand(0, 1),
            'startDate' => $startDate,
            'endDate'   => $endDate,
        ];
    }
}
