<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\MonthlyExpenses;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'toDate' => $this->faker->dateTimeBetween('-12 month', 'now'),
            'amount' => $this->faker->numberBetween(100, 10000)
        ];
    }

    /**
     * @return array
     */
    public function setForeignKeys()
    {
        return $this->state(function (array $attributes) {
            $expense = DB::table('expenses')->get()->random();

            return [
                'expenseId' => $expense->id,
                'categoryId' => $expense->categoryId,
                'userId' => $expense->userId,
            ];
        });
    }
}
