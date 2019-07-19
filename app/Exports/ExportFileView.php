<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportFileView implements FromView, ShouldAutoSize
{
  use Exportable;
  private $myView;
  private $myData;

  public function __construct($data){
    $this->myView = $data['view'] ?? [];
    $this->myData = $data['data'] ?? [];
  }

  public function view(): View
  {
    return view($this->myView, ['results' => $this->myData]);
  }

}



