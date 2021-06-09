<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;
use App\Exports\RolesExport;
use Illuminate\Http\Request;



class RolesExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }

    public function export_excel() {

        return $this->excel->download(new RolesExport, 'roles.xlsx');
    }

    public function export_csv() {

        return $this->excel->download(new RolesExport, 'roles.csv', Excel::CSV);
    }
}
