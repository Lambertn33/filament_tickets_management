<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_roles')->delete();

        $adminRole = Role::where('title', Role::ADMINROLE)->first();

        $agentRole = Role::where('title', Role::AGENTROLE)->first();

        $adminPermissions = Permission::all();

        $agentPermissions = Permission::whereIn(
            'title',
            [
                'category_show',
                'category_access',
                'label_show',
                'label_access',
                'ticket_show',
                'ticket_access'
            ]
        )->get();
        $adminRole->permissions()->sync($adminPermissions);

        $agentRole->permissions()->sync($agentPermissions);
    }
}
