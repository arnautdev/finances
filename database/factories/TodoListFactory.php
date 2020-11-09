<?php

namespace Database\Factories;

use App\Models\TodoList;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'userId' => 1,
            'description' => $this->faker->text,
            'isDone' => 'no'
        ];
    }
}
