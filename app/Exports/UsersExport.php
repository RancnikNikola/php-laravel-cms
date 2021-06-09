<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, ShouldAutoSize, WithMapping
{
    use Exportable;

    private $filename = "users.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
       
    }

    public function map($user): array {
        return [
            $user->id,
            $user->name,
            $user->surname,
            $user->email,
            $user->last_login
        ];
    }
}
