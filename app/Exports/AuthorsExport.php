<?php

namespace App\Exports;

use App\Author;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuthorsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Author::all();
    }

    public function headings(): array
    {
        // Return an empty array to exclude headings
        return ['id', 'name', 'created_at', 'updated_at'];
    }
}
