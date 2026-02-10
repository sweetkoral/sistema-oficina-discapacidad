<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $adminRole = Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Funcionario']);
        Role::create(['name' => 'Consulta']);

        $admin = \App\Models\User::create([
            'name' => 'Admin Oficina',
            'email' => 'admin@oficina.cl',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $admin->assignRole($adminRole);

        $demo = \App\Models\User::create([
            'name' => 'Demo Cochamó',
            'email' => 'demo@cochamo.cl',
            'password' => \Illuminate\Support\Facades\Hash::make('cochamo'),
        ]);

        $demo->assignRole($adminRole);
    }
}
