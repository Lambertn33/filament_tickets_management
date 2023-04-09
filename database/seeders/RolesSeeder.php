<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();
        $roles = [];
        foreach (Role::ROLES as $role) {
            $roles[] = [
                'title' => $role,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        Role::insert($roles);
    }
}
