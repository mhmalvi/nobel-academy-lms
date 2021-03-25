<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Activation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Quadque Tech',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'is_admin' => '1',
            'user_type' => 'staff'
        ]);

        Activation::create([
            'type' => 'maintenance',
            'status' => '0'
        ]);
    }
}
