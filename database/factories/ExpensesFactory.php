<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'expenseType' => $this->faker->randomElement(['dynamic', 'static']),
            'dynamicAmount' => $this->faker->randomElement(['no', 'yes']),
            'amount' => $this->faker->numberBetween(100, 1000),
            'isAutoAdd' => $this->faker->randomElement(['no', 'yes'])
        ];
    }

    /**
     * @return array
     */
    public function setForeignKeys()
    {
        return $this->state(function (array $attributes) {
            $category = DB::table('expense_categories')->get()->random();

            return [
                'categoryId' => $category->id,
                'userId' => $category->userId,
            ];
        });
    }
}
