<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guards = config('auth.guards');

        foreach ($guards as $guardName => $settings) {
            $data['name'] = ucfirst($guardName);
            \Spatie\Permission\Models\Role::create($data);
        }

        \App\User::create([
            'firstname' => 'Dmitry',
            'lastname' => 'Arnaut',
            'email' => 'dmitrii.arnaut@gmail.com',
            'company' => 'FANSYBOX',
            'password' => \Illuminate\Support\Facades\Hash::make('dmitrii.arnaut@gmail.com'),
        ]);

    }
}
