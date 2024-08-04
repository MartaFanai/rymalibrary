<?php

namespace App\Imports;

use App\Publisher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PublishersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $exists = Publisher::where('name', $row['name'])->exists();

        if(!$exists)
            return new Publisher([
                "name" => $row['name'],
            ]);
    }
}
