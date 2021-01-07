<?php

namespace Database\Factories;

use App\Models\Goal;
use App\Models\GoalAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GoalAction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'goalId' => Goal::factory(),
            'startDateTime' => $this->faker->dateTimeBetween('-12 month', 'now'),
            'weekDays' => [$this->faker->numberBetween(1, 7), $this->faker->numberBetween(1, 7)],
            'addToTodoList' => $this->faker->randomElement(['yes', 'no']),
        ];
    }


}
