<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportFileMultipleSheet implements WithMultipleSheets, ShouldAutoSize
{
  use Exportable;

  private $myData;
  private $dataStructure;

  public function __construct($data){
    $this->myData = $data['data'] ?? [];
    $this->dataStructure = $data['dataStructure'] ?? 'collection';
  }

  public function sheets(): array
  {
    $sheets = [];
    if($this->dataStructure == 'collection'){
      foreach ($this->myData as $data){
        $sheets[] = new ExportFileCollection($data);
      }
    }elseif($this->dataStructure == 'array'){
      foreach ($this->myData as $data){
        $sheets[] = new ExportFileArray($data);
      }
    }elseif($this->dataStructure == 'query'){
      foreach ($this->myData as $data){
        $sheets[] = new ExportFileQuery($data);
      }
    }elseif($this->dataStructure == 'view'){
      foreach ($this->myData as $data){
        $sheets[] = new ExportFileView($data);
      }
    }
    return $sheets;
  }

}



