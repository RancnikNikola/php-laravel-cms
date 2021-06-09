<?php

namespace App\Exports;

use App\Models\Role;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;

class RolesExport implements FromCollection, ShouldAutoSize, WithMapping
{
    use Exportable;

    private $filename = "roles.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Role::all();
       
    }

    public function map($role): array {
        return [
            $role->id,
            $role->name,
            $role->slug,
            $role->permissions
        ];
    }
}
