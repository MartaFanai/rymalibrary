<?php

namespace App\Exports;

use App\Publisher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PublishersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Publisher::all();
    }

    public function headings(): array
    {
        // Return an empty array to exclude headings
        return ['id', 'name', 'created_at', 'updated_at'];
    }
}
