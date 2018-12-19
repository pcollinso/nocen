<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleTableSeeder extends Seeder
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
                'title' => 'Alhaji',
            ],
            [
                'id' => 2,
                'title' => 'Alhaja',
            ],
            [
                'id' => 3,
                'title' => 'Barrister',
            ],
            [
                'id' => 4,
                'title' => 'Dr',
            ],
            [
                'id' => 5,
                'title' => 'Engr',
            ],
            [
                'id' => 6,
                'title' => 'Miss',
            ],
            [
                'id' => 7,
                'title' => 'Mr',
            ],
            [
                'id' => 8,
                'title' => 'Mrs',
            ],
            [
                'id' => 9,
                'title' => 'Pastor',
            ],
            [
                'id' => 10,
                'title' => 'Rev',
            ]
        ];

        DB::table('sup_title')->insert($data);
    }
}
