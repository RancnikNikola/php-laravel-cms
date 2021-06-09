<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;
use App\Exports\UsersExport;
use Illuminate\Http\Request;



class UsersExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel) {
        $this->excel = $excel;
    }

    public function export_excel() {

        return $this->excel->download(new UsersExport, 'users.xlsx');
    }

    public function export_csv() {

        return $this->excel->download(new UsersExport, 'users.csv', Excel::CSV);
    }
}
