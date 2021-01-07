<?php

namespace Database\Factories;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Goal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'startDate' => $this->faker->dateTimeBetween('-12 month', 'now'),
            'endDate' => $this->faker->dateTimeBetween('-12 month', 'now'),
        ];
    }

    /**
     * @return GoalActionFactory
     */
    public function setUserId()
    {
        return $this->state(function () {
            $userId = User::all()->random()->id;

            return [
                'userId' => $userId
            ];
        });
    }
}
