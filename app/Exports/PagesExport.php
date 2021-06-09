<?php

namespace App\Exports;

use App\Models\Page;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;

class PagesExport implements FromCollection, ShouldAutoSize, WithMapping
{
    use Exportable;

    private $filename = "pages.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Page::all();
       
    }

    public function map($page): array {
        return [
            $page->id,
            $page->title,
            $page->content,
        ];
    }
}
