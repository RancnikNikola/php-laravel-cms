<?php

namespace App\Exports;

use App\Models\Nav;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;

class NavsExport implements FromCollection, ShouldAutoSize, WithMapping
{
    use Exportable;

    private $filename = "navs.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Nav::all();
       
    }

    public function map($nav): array {
        return [
            $nav->id,
            $nav->page_id,
            $nav->name,
        ];
    }
}
