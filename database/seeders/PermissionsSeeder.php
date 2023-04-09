<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->delete();
        $roles = [];
        foreach (Permission::PERMISSIONS as $permission) {
            $roles[] = [
                'title' => $permission,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        Permission::insert($roles);
    }
}
