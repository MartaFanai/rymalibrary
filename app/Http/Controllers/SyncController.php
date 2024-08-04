<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Activate for Online_books table
// use App\OnlineBook;
use App\UpdateBook;
use App\Book;
use App\Author;
use App\Publisher;

class SyncController extends Controller
{
    public function list()
    {
            // It check if it is connected to internet or not
        // $online = $this->isOnline();
        $online = 1;
            // Delete a record from Update_book table where del=1 i.e books that are deleteted from books table
        // $del = $this->checkbook();
            //This count the number of changes made in the books table that are mark upload=1
        $nos = $this->code();

        if($online == 0)
        {
            return back()->with('warning','No Internet connection<br>Sync not executed');
        }
        while($nos > 0)
        {
            // This enter all the books that have upload=1
            $id = $this->entry();
            
            Book::where('id', $id)->update(['upload'=> 0]);

            $nos--;
        }
        

        return back()->with('success','Sync Database successfully');
    }

    public function downloadCsv()
    {
        // Query the "update_books" table to retrieve the data you want to include in the CSV file
        $books = DB::table('update_books')->get();
        $filename = date('d-m-Y') . '_updatebooks.csv';

        // Use the PHP function fopen to open a new file pointer to a temporary file
        $file = fopen('php://temp', 'w');

        // Use the fputcsv function to write each row of data to the file pointer
        foreach ($books as $book) {
            fputcsv($file, [$book->id, $book->bookid, $book->title, $book->author, $book->edition, $book->year, $book->publisher, $book->pages, $book->accessionno, $book->classificationno, $book->subject, $book->bookno, $book->description, $book->price, $book->location, $book->qty, $book->member_id, $book->issuer, $book->del, date('d-m-Y', strtotime($book->created_at)), date('d-m-Y', strtotime($book->updated_at))]);
        }

        // Move the file pointer back to the beginning of the file
        rewind($file);

        UpdateBook::truncate();
        // Send the file as a CSV attachment to the user's browser
        return response()->streamDownload(function () use ($file) {
            fpassthru($file);
        }, $filename );

    }

    public function code()
    {
        $count = Book::where('upload', 1)->orderBy('id', 'ASC')->count();
        
        return $count;
    }

    public function entry(){
        $query = Book::where('upload', 1)->orderBy('id', 'ASC')->first();

        $ins = new UpdateBook;

        $ins->bookid = $query->id;
        $ins->title = $query->title;
        $ins->author = $query->author->name;
        $ins->edition = $query->edition;
        $ins->year = $query->year;
        $ins->publisher = $query->publisher->name;
        $ins->pages = $query->pages;
        $ins->accessionno = $query->accessionno;
        $ins->classificationno = $query->classificationno;
        $ins->subject = $query->subject;
        $ins->bookno = $query->bookno;
        $ins->description = $query->description;
        $ins->price = $query->price;
        $ins->location = $query->location;
        $ins->qty = $query->qty;
        $ins->member_id = $query->member_id;
        $ins->issuer = $query->issuer;
        $ins->created_at = $query->created_at;
        $ins->updated_at = $query->updated_at;

        $ins->save();

        return $query->id;
    }

    public function syncnow($nos){
        $i = 1;
        while($nos > 0)
        {
            $beg = $nos;          

            $id = $this->upload();
            
            UpdateBook::destroy($id);

            $nos--;

            $i++;

            if($i > 50)
            {
                $tot = $beg - $nos;
                return back()->with('success','You have sync '.$tot.' records from '.$beg.'');
            }
        }
    }

    public function isOnline(){
        
      $page = @file_get_contents('https://www.google.co.in');

      if($page)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }

    public function upload(){
        
        $query = UpdateBook::all()->first();
        // $check = OnlineBook::find($query->bookid);

        if(!$query)
        { 
            return $this->notExist($query); 
        }
        else
        { 
            // echo "exist"; 
            return $this->isExist($query);
        }


    }

    public function isExist($query){
        try{
        UpdateBook::where('id', $query->bookid)
        ->update([  'title'=> $query->title, 
                    'author'=> $query->author->name, 
                    'edition'=> $query->edition, 
                    'year'=> $query->year, 
                    'publisher'=> $query->publisher->name, 
                    'pages'=> $query->pages, 
                    'accessionno'=> $query->accessionno, 
                    'classificationno'=> $query->classificationno, 
                    'subject'=> $query->subject, 
                    'bookno'=> $query->bookno, 
                    'description'=> $query->description, 
                    'price'=> $query->price, 
                    'location'=> $query->location, 
                    'qty'=> $query->qty, 
                    'member_id'=> $query->member_id, 
                    'issuer'=> $query->issuer, 
                    'created_at'=> $query->created_at, 
                    'updated_at'=> $query->updated_at ]);
        }catch (\Illuminate\Database\QueryException $e) {
            
            return back()->with('warning','Error with data updating update_books<br>Please try again');
        }

        return $query->id;
    }

    public function notExist($query){
        
        $ins = new UpdateBook;

        $ins->id = $query->bookid;
        $ins->title = $query->title;
        $ins->author = $query->author->name;
        $ins->edition = $query->edition;
        $ins->year = $query->year;
        $ins->publisher = $query->publisher->name;
        $ins->pages = $query->pages;
        $ins->accessionno = $query->accessionno;
        $ins->classificationno = $query->classificationno;
        $ins->subject = $query->subject;
        $ins->bookno = $query->bookno;
        $ins->description = $query->description;
        $ins->price = $query->price;
        $ins->location = $query->location;
        $ins->qty = $query->qty;
        $ins->member_id = $query->member_id;
        $ins->issuer = $query->issuer;
        $ins->created_at = $query->created_at;
        $ins->updated_at = $query->updated_at;

        $ins->save();

        return $query->id;
    }

    public function checkbook(){
        $count = UpdateBook::where('del', 1)->count();

        while($count > 0){
            $query = UpdateBook::where('del', 1)->first();

            UpdateBook::destroy($this->delbook($query));

            $count--;
        }

        return $count;
    }

    public function delbook($query){
        OnlineBook::destroy($query->bookid);

        return $query->id;
    }

}
