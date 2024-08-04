<?php

namespace App\Imports;

use DB;
use App\Book;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use RealRashid\SweetAlert\Facades\Alert;

class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function rules(): array
    {
        return [
            // Define validation rules for each column
            'author_id' => 'required|integer', 
            'publisher_id' => 'required|integer', 
            // Add rules for other columns as needed
        ];
    }

    public function model(array $row)
    {

       $exists = Book::where('accessionno', $row['accessionno'])->exists();

       if(!$exists){
        return new Book([
            "title" => $row['title'],
            // "author_id" => 0, This line is for existing RTV YMA
            "author_id" => $row['author_id'] ?? 0,
            "edition" => $row['edition'],
            "volume" => $row['volume'],
            "year" => $row['year'],
            // "publisher_id" => 0, This line is for existing RTV YMA
            "publisher_id" => $row['publisher_id'] ?? 0,
            "pages" => $row['pages'],
            "accessionno" => $row['accessionno'],
            "classificationno" => $row['classificationno'],
            "subject" => $row['subject'],
            "bookno" => $row['bookno'],
            "description" => $row['description'],
            "price" => $row['price'],
            "location" => $row['location'],
            "qty" => 1,
            "member_id" => 0,
            "issuer" => null,
            "upload" => 0,
            // "author_id" => $authorId != 0 ? $authorId : 0,
        ]);
        }
       
    }
}
