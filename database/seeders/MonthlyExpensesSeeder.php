<?php

namespace Database\Seeders;

use App\Models\MonthlyExpenses;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthlyExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user)
    {
        $categoryIds = DB::table('expense_categories')
            ->where('userId', '=', $user->id)
            ->get();

        $expenseIds = DB::table('expenses')
            ->where('userId', '=', $user->id)
            ->where('isAutoAdd', '=', 'no')
            ->get();

        for ($i = 0; $i <= 10; $i++) {
            MonthlyExpenses::factory(1)->create([
                'userId' => $user->id,
                'expenseId' => $expenseIds->random()->id,
                'categoryId' => $categoryIds->random()->id
            ]);
        }
    }
}
