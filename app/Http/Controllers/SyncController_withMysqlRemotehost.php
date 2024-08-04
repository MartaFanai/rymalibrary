<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\OnlineBook;
use App\UpdateBook;
use App\Book;

class SyncController extends Controller
{
    public function list()
    {
        $online = $this->isOnline();
        $del = $this->checkbook();
        $nos = $this->code();

        if($online == 0)
        {
            return back()->with('warning','No Internet connection<br>Sync not executed');
        }
        while($nos > 0)
        {
            $id = $this->entry();
            
            Book::where('id', $id)->update(['upload'=> 0]);

            $nos--;
        }
        

        $count = UpdateBook::all()->count();

        if($count != 0 && $nos == 0){

            $this->syncnow($count);
        }
        
        // return OnlineBook::all();
        // return DB::connection('mysql2')->table('books')->get();

        return back()->with('success','Sync Database successfully');
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
        $ins->author = $query->author;
        $ins->edition = $query->edition;
        $ins->year = $query->year;
        $ins->publisher = $query->publisher;
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
        $check = OnlineBook::find($query->bookid);

        if(!$check)
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
        OnlineBook::where('id', $query->bookid)
        ->update([  'title'=> $query->title, 
                    'author'=> $query->author, 
                    'edition'=> $query->edition, 
                    'year'=> $query->year, 
                    'publisher'=> $query->publisher, 
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
            
            return back()->with('warning','Error with data updating online database<br>Please try again');
        }

        return $query->id;
    }

    public function notExist($query){
        
        $ins = new OnlineBook;

        $ins->id = $query->bookid;
        $ins->title = $query->title;
        $ins->author = $query->author;
        $ins->edition = $query->edition;
        $ins->year = $query->year;
        $ins->publisher = $query->publisher;
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
