<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
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


        $users = User::all();
        foreach ($users as $user) {
            $this->callWith(ExpensesSeeder::class, ['user' => $user]);
            $this->callWith(MonthlyExpensesSeeder::class, ['user' => $user]);
        }

    }
}
