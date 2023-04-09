<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert(array(
            0 => array(
                'name' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12345')
            ),
            1 => array(
                'name' => 'agent',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('agent12345')
            ),
            2 => array(
                'name' => 'agent 2',
                'email' => 'agent2@gmail.com',
                'password' => Hash::make('agent12345')
            ),
        ));
    }
}
