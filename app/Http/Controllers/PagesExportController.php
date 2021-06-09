<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;
use App\Exports\PagesExport;
use Illuminate\Http\Request;



class PagesExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }

    public function export_excel() {

        return $this->excel->download(new PagesExport, 'pages.xlsx');
    }

    public function export_csv() {

        return $this->excel->download(new PagesExport, 'pages.csv', Excel::CSV);
    }
}
