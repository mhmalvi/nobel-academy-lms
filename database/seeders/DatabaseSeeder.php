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
        $steps = ['Unit Assessment summary', 'Resources', 'Powerpoint Presentation', 'Workbook', 'Assessment'];
        $stepsThumb = ['wisdom.png', 'homework.png', 'presentation.png', 'workbook.png', 'compliance.png'];
        $category = ['diploma', 'certificate iii', 'certificate iv'];

        DB::table('users')->insert([
            'name' => 'Quadque Tech',
            'email' => 'admin@learnque.com',
            'password' => Hash::make('admin'),
        ]);

        DB::table('user_infos')->insert([
            'user_id' => 1
        ]);


        for ($i = 0; $i < count($steps); $i++) {
            DB::table('steps')->insert([
                'step_name' => $steps[$i],
                'thumbnail' => $stepsThumb[$i]
            ]);

            DB::table('course_categories')->insert([
                'category_name' => $category[$i]
            ]);
        }


        Activation::create([
            'type' => 'maintenance',
            'status' => '0'
        ]);
    }
}
