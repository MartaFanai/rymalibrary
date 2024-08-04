<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Toaster;
use App\Issue;
use App\OnlineBook;
use App\UpdateBook;
use App\Book;
use App\Setting;
use App\Members;
use App\Register;
use App\Record;
use DB;


class DynamicFieldController extends Controller
{
    function index($id)
    {
     $arr1['member'] = Members::where("id", $id)->get();
     $data['issue'] = Issue::where("member_id", $id)->orderBy('issueDate')->get();
     $arr['book'] = Book::where('qty', 1)->orderBy('title')->get();
     $arr2['setting'] = Setting::find(1)->first();

     return view('issue/dynamic_field')->with($arr)->with($data)->with($arr1)->with($arr2);
    }

    function insert(Request $request) 
    {
      $validator = Validator::make($request->all(), [
            'book_id.*'  => 'required',
            'member_id.*' => 'required',
            'issueDate.*'  => 'required',
            'retDate.*'  => 'required',
        ]);
         if ($validator->fails()) {
           return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

     if($request)
     {
      $user = auth()->user()->name;
      $user_id = auth()->user()->id;
      $book_id = $request->book_id;
      $member_id = $request->member_id;
      $issueDate = $request->issueDate;
      $retDate = $request->retDate;
      for($count = 0; $count < count($book_id); $count++)
      {
        DB::update('update books set qty = ?, member_id = ?, issuer = ?, upload = ? where id = ?', [0, $member_id[$count], $user, 1, $book_id[$count]]);
        // DB::insert('insert into book_member (book_id, member_id) VALUES (?, ?)', [$book_id[$count], $member_id[$count]]);
       $data = array( 
       	'book_id' => $book_id[$count],
       	'member_id' => $member_id[$count],
        'users_name' => $user,
        'users_id' => $user_id,
        'issueDate' => $issueDate[$count],
        'retDate'  => $retDate[$count],
        'created_at' => now()
       );
       $insert_data[] = $data; 
      }

      $year = date("Y", strtotime($issueDate[0]));
      $month = date("m", strtotime($issueDate[0]));
      

      $check_year = DB::select('select year from registers where year = ?', [$year]);
      $check_month = DB::select('select month from registers where month = ?', [$month]);
      

      if( count($check_year) == 0)
      {
          //insert all data (year month and nos)
        $mnth = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
       
        for($i=0; $i < count($mnth); $i++){
          $da = array(
            'year'  => $year,
            'month' => $mnth[$i]
          );
          $ins[] = $da;
        }
        Register::insert($ins);
        $no = 1;
        
        DB::update('update registers set issue = ? where year =? and month = ?', [$no, $year, $month]);
      }
      elseif (count($check_year) > 0 && count($check_month) == 0) {
        //insert only month and nos
        $ins = new Register;
        $ins->year = $year;
        $ins->month = $month;
        $ins->issue = 1;
        $ins->save();
        
      }
      else
      {
        //update only nos.
        $nos = DB::select('select issue from registers where month = ? AND year = ?', [$month, $year]);
        $iss = $nos[0]->issue + 1;
        
        DB::update('update registers set issue = ? where year = ? and month = ?', [$iss, $year, $month]);        
      }

      //Keep track to control records of most books borrowed
      $numbers = $request->book_id;
        
        foreach($numbers as $num)
        {
          $detail = Book::find($num);

          $exists = Record::where('title', $detail->title)->where('author_id', $detail->author_id)->exists();

            if($exists)
            {
              Record::where('title', $detail->title)->where('author_id', $detail->author_id)
                ->update(['borrow_count' => DB::raw('borrow_count + 1')]);
            }
            else
            {
              Record::insert(['title' => $detail->title, 'author_id' => $detail->author_id]);
            }

        }

      Issue::insert($insert_data);
      
      return back()->with('success', 'Book issued Successfully.');
      
     }
    }
}
