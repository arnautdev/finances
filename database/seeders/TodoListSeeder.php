<?php

namespace Database\Seeders;

use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoList::factory(30)->create();
    }
}
