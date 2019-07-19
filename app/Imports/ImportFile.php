<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportFile implements ToModel
{

    private $myModel;
    private $myColumns;

    public function __construct($data){
        $this->myModel = $data['model'] ?? [];
        $this->myColumns = $data['columns'] ?? [];
    }

    public function model(array $columns)
    {
        $structure = [];
        $i = 0;
        foreach ($this->myColumns as $col){
            $structure[$col] = $col != 'password' ? $columns[$i] : Hash::make($columns[$i]);
            $i ++;
        }
        return new $this->myModel($structure);
    }


}
