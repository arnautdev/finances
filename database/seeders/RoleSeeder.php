<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guards = config('auth.guards');
        foreach ($guards as $guard => $guardSettings) {
            $guardName = ucfirst($guard);
            Role::create([
                'guard_name' => $guard,
                'name' => $guardName,
            ]);
        }
    }
}
