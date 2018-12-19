<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
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
                'id' => '1',
                'state' =>  'ABIA',
                'abreviation' =>  'AB',
                'country_id' =>  '3',
                'entered_by' =>  '13',
            ],
            [
            'id' => '2',
            'state' =>  'ADAMAWA',
            'abreviation' =>  'ADM',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '3',
            'state' =>  'AKWA IBOM',
            'abreviation' =>  'AKW',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '4',
            'state' =>  'ANAMBRA',
            'abreviation' =>  '4',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '5',
            'state' =>  'BAUCHI',
            'abreviation' =>  '5',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '6',
            'state' =>  'BAYELSA',
            'abreviation' =>  '6',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '7',
            'state' =>  'BENUE',
            'abreviation' =>  '7',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '8',
            'state' =>  'BORNO',
            'abreviation' =>  '8',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '9',
            'state' =>  'CROSS RIVER',
            'abreviation' =>  '9',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '10',
            'state' =>  'DELTA',
            'abreviation' =>  '10',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '11',
            'state' =>  'EBONYI',
            'abreviation' =>  '11',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '12',
            'state' =>  'EDO',
            'abreviation' =>  '12',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '13',
            'state' =>  'EKITI',
            'abreviation' =>  '13',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '14',
            'state' =>  'ENUGU',
            'abreviation' =>  '14',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '15',
            'state' =>  'FCT',
            'abreviation' =>  '37',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '16',
            'state' =>  'GOMBE',
            'abreviation' =>  '15',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '17',
            'state' =>  'IMO',
            'abreviation' =>  '16',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '18',
            'state' =>  'JIGAWA',
            'abreviation' =>  '17',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '19',
            'state' =>  'KADUNA',
            'abreviation' =>  '18',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '20',
            'state' =>  'KANO',
            'abreviation' =>  '19',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '21',
            'state' =>  'KATSINA',
            'abreviation' =>  '20',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '22',
            'state' =>  'KEBBI',
            'abreviation' =>  '21',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '23',
            'state' =>  'KOGI',
            'abreviation' =>  '22',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '24',
            'state' =>  'KWARA',
            'abreviation' =>  '23',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '25',
            'state' =>  'LAGOS',
            'abreviation' =>  '24',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '26',
            'state' =>  'NASARAWA',
            'abreviation' =>  '25',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '27',
            'state' =>  'NIGER',
            'abreviation' =>  '26',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '28',
            'state' =>  'OGUN',
            'abreviation' =>  '27',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '29',
            'state' =>  'ONDO',
            'abreviation' =>  '28',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '30',
            'state' =>  'OSUN',
            'abreviation' =>  '29',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '31',
            'state' =>  'OYO',
            'abreviation' =>  '30',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '32',
            'state' =>  'PLATEAU',
            'abreviation' =>  '31',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '33',
            'state' =>  'RIVERS',
            'abreviation' =>  '32',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '34',
            'state' =>  'SOKOTO',
            'abreviation' =>  '33',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '35',
            'state' =>  'TARABA',
            'abreviation' =>  '34',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '36',
            'state' =>  'YOBE',
            'abreviation' =>  '35',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ],
            [
            'id' => '37',
            'state' =>  'ZAMFARA',
            'abreviation' =>  '36',
            'country_id' =>  '3',
            'entered_by' =>  '13',
            ]
        ];

        DB::table('sup_state')->insert($data);
    }
}
