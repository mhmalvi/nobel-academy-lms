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
        $datas = ['admin', 'teacher', 'student'];
        $steps = ['step-01', 'step-02', 'step-03', 'step-04', 'step-05'];
        
        foreach($datas as $data){
            DB::table('roles')->insert([
                'name' => $data
            ]);
        }
        
        DB::table('users')->insert([
            'name' => 'Quadque Tech',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'is_admin' => '1',
            'user_type' => 'staff'
        ]);


        foreach($steps as $step){
            DB::table('steps')->insert([
                'action_user' => 1,
                'step_name' => $step
            ]);
        }


        Activation::create([
            'type' => 'maintenance',
            'status' => '0'
        ]);
    }
}
