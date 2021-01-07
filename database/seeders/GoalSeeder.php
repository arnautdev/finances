<?php

namespace Database\Seeders;

use App\Models\Goal;
use App\Models\GoalAction;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goal::factory(10)
            ->has(GoalAction::factory()->count(1))
            ->setUserId()
            ->create();
    }
}
