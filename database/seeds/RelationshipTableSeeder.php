<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RelationshipTableSeeder extends Seeder
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
                'relationship' => 'Aunt',
            ],
            [
                'id' => 2,
                'relationship' => 'Brother',
            ],
            [
                'id' => 3,
                'relationship' => 'Cousin',
            ],
            [
                'id' => 4,
                'relationship' => 'Daughter',
            ],
            [
                'id' => 5,
                'relationship' => 'Father',
            ],
            [
                'id' => 6,
                'relationship' => 'Friend',
            ],
            [
                'id' => 7,
                'relationship' => 'Husband',
            ],
            [
                'id' => 8,
                'relationship' => 'Mother',
            ],
            [
                'id' => 9,
                'relationship' => 'Nephew',
            ],
            [
                'id' => 10,
                'relationship' => 'Niece',
            ],
            [
                'id' => 11,
                'relationship' => 'Sister',
            ],
            [
                'id' => 12,
                'relationship' => 'Son',
            ],
            [
                'id' => 13,
                'relationship' => 'Uncle',
            ],
            [
                'id' => 14,
                'relationship' => 'Wife',
            ]
        ];

        DB::table('sup_relationships')->insert($data);
    }
}
