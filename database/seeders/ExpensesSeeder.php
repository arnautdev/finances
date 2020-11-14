<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpensesSeeder extends Seeder
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
            ->get()
            ->pluck('id');

        for ($i = 0; $i <= 10; $i++) {
            Expenses::factory(1)->create([
                'userId' => $user->id,
                'categoryId' => $categoryIds->random()
            ]);
        }

    }
}
