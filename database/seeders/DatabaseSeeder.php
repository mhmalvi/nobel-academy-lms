<?php

namespace Database\Seeders;

use App\Models\Activation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $steps = ['step-01', 'step-02', 'step-03', 'step-04', 'step-05'];

        DB::table('users')->insert([
            'name' => 'Quadque Tech',
            'email' => 'admin@learnque.com',
            'password' => Hash::make('admin'),
        ]);

        DB::table('user_infos')->insert([
            'user_id' => 1
        ]);


        foreach ($steps as $step) {
            DB::table('steps')->insert([
                'step_name' => $step
            ]);
        }


        Activation::create([
            'type' => 'maintenance',
            'status' => '0'
        ]);
    }
}
