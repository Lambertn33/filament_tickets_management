<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_users')->delete();

        $adminRole = Role::where('title', Role::ADMINROLE)->first();

        $agentRole = Role::where('title', Role::AGENTROLE)->first();

        $userAdmin = User::where('email', 'admin@gmail.com')->first();

        $userAgent = User::where('email', 'agent@gmail.com')->first();

        $userAgent2 = User::where('email', 'agent2@gmail.com')->first();

        $userAdmin->roles()->sync($adminRole);

        $userAgent->roles()->sync($agentRole);

        $userAgent2->roles()->sync($agentRole);
    }
}
