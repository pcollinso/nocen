<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportFileQuery implements FromQuery, WithHeadings, ShouldAutoSize
{
  use Exportable;
  private $myQuery;
  private $myHeadings;

  public function __construct($data){
    $this->myQuery = $data['query'] ?? [];
    $this->myHeadings = $data['headings'] ?? [];
  }

  public function query(){
    return $this->myQuery;
  }

  public function headings(): array{
    return $this->myHeadings;
  }

}



