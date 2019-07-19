<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportFileCollection implements FromCollection, WithHeadings, ShouldAutoSize
{
  use Exportable;
  private $myCollection;
  private $myHeadings;

  public function __construct($data){
    $this->myCollection = $data['collection'] ?? [];
    $this->myHeadings = $data['headings'] ?? [];
  }

  public function collection()
  {
    return $this->myCollection;
  }

  public function headings(): array{
    return $this->myHeadings;
  }


}



