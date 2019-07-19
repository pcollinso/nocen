<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportFileArray implements  WithHeadings, FromArray, ShouldAutoSize
{
  use Exportable;
  private $myArray;
  private $myHeadings;

  public function __construct($data){
    $this->myArray = $data['array'] ?? [];
    $this->myHeadings = $data['headings'] ?? [];
  }

  public function array(): array{
    return $this->myArray;
  }

  public function headings(): array{
    return $this->myHeadings;
  }

}



