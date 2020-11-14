<?php

namespace Database\Factories;

use App\Models\Expenses;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpensesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expenses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(10),
            'expenseType' => $this->faker->randomElement(['monthly', 'dynamic', 'static']),
            'dynamicAmount' => $this->faker->randomElement(['no', 'yes']),
            'amount' => $this->faker->numberBetween(100, 1000),
            'isAutoAdd' => $this->faker->randomElement(['no', 'yes'])
        ];
    }
}
