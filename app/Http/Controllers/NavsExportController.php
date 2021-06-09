<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;
use App\Exports\NavsExport;
use Illuminate\Http\Request;



class NavsExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }

    public function export_excel() {

        return $this->excel->download(new NavsExport, 'navs.xlsx');
    }

    public function export_csv() {

        return $this->excel->download(new NavsExport, 'navs.csv', Excel::CSV);
    }
}
