<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'module_name' => 'MANAGEMENT',
                'is_service' => 0,
            ],
            [
                'id' => 2,
                'module_name' => 'ACADEMIC',
                'is_service' => 1,
            ],
            [
                'id' => 3,
                'module_name' => 'HOSTEL',
                'is_service' => 1,
            ],
            [
                'id' => 5,
                'module_name' => 'SELF SERVICE',
                'is_service' => 0,
            ]
        ];

        DB::table('sup_module')->insert($data);
    }
}
