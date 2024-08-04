<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }

    public function headings(): array
    {
        // Return an empty array to exclude headings
        return ['id', 'title', 'author_id', 'edition', 'year', 'publisher_id', 'pages', 'accessionno', 'classificationno', 'subject', 'bookno', 'description', 'price', 'location', 'qty', 'member_id', 'issuer', 'upload', 'created_at', 'updated_at'];
    }
}
