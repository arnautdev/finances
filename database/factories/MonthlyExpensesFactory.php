<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\MonthlyExpenses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthlyExpensesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MonthlyExpenses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'userId' => User::factory(),
//            'expenseId' => Expenses::factory(),
//            'categoryId' => ExpenseCategory::factory(),
            'toDate' => $this->faker->dateTimeThisMonth(),
            'amount' => $this->faker->numberBetween(100, 10000)
        ];
    }
}
