<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\MonthlyExpenses;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
            ->has(TodoList::factory()->count(7))
            ->has(ExpenseCategory::factory()->count(10))
            ->create();

        Expenses::factory(98)->setForeignKeys()->create();

        MonthlyExpenses::factory(20000)->setForeignKeys()->create();
    }
}
