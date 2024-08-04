<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Members;
use App\Issue;
use App\Book;
use App\Setting;
use App\Receipt;
use App\Register;
use App\Returnreport;
use App\User;
use DB;
use PDF; 


class ReturnController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$arr['return'] = Issue::all();

    	return view('return/index')->with($arr);
    }

    public function retBybook()
    {
      $arr['return'] = Issue::all();
      
      return view('return/index1')->with($arr);
    }

    public function return($id)
    {
    	$arr['return'] = Issue::where('member_id', $id)->get();
      $arr1['rate'] = Setting::find(1)->first();

    	return view('return/return')->with($arr)->with($arr1);
    }

    public function returnBook($id)
    {
      $arr['return'] = Issue::where('book_id', $id)->get();
      $arr1['rate'] = Setting::find(1)->get()->first();
    
      return view('return/return')->with($arr)->with($arr1);
    }

    public function retBooks($id)
    {
      $b = Issue::find($id);
      $mem_id = $b->member_id;
      $user = auth()->user()->name;

      DB::delete('delete from book_member WHERE book_id = ? AND member_id =?', [$b->book_id, $b->member_id]);

      DB::update('update books set qty = ?, member_id = ?, issuer = ?, upload = ? where id = ?', [1,0,NULL, 1, $b->book_id]);

      $year = date("Y");
      $month = date("m");
 
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
        
        DB::update('update registers set ret = ? where year =? and month = ?', [$no, $year, $month]);
       
      }
      elseif (count($check_year) > 0 && count($check_month) == 0) {
        //insert only month and nos
        $ins = new Register;
        $ins->year = $year;
        $ins->month = $month;
        $ins->ret = 1;
        $ins->save();
        
      }
      else
      {
        //update only nos.
        $nos = DB::select('select ret from registers where month = ? AND year = ?', [$month, $year]);
        $ret = $nos[0]->ret + 1;

        DB::update('update registers set ret= ? where year = ? and month = ?', [$ret, $year, $month]);        
      }

      $mid = Issue::where('id', $id)->get()->first();
      $cur_day = \Carbon\Carbon::now();

      $ret = new Returnreport;
      $ret->book_id = $mid->book_id;
      $ret->member_id = $mid->member_id;
      $ret->issue_users = $mid->users_name;
      $ret->return_users = $user;
      $ret->issueDate = $mid->issueDate;
      $ret->retDate = $cur_day;
      $ret->save();

    	Issue::destroy($id);

      $arr['return'] = Issue::all();
      $res = DB::select('select id from issues where member_id = ?', [$mid->member_id]);

      
    	 return redirect()->route('return')->with('success', 'Book have been returned.');
       	
    }

    public function returnAllBooks($encodedIds)
    {

      $idArray = explode(',', $encodedIds);
      foreach ($idArray as $id) {
          
        $b = Issue::find($id);
        $mem_id = $b->member_id;
        $user = auth()->user()->name;

        DB::delete('delete from book_member WHERE book_id = ? AND member_id =?', [$b->book_id, $b->member_id]);

        DB::update('update books set qty = ?, member_id = ?, issuer = ?, upload = ? where id = ?', [1,0,NULL, 1, $b->book_id]);

        $year = date("Y");
        $month = date("m");
   
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
          
          DB::update('update registers set ret = ? where year =? and month = ?', [$no, $year, $month]);
         
        }
        elseif (count($check_year) > 0 && count($check_month) == 0) {
          //insert only month and nos
          $ins = new Register;
          $ins->year = $year;
          $ins->month = $month;
          $ins->ret = 1;
          $ins->save();
          
        }
        else
        {
          //update only nos.
          $nos = DB::select('select ret from registers where month = ? AND year = ?', [$month, $year]);
          $ret = $nos[0]->ret + 1;

          DB::update('update registers set ret= ? where year = ? and month = ?', [$ret, $year, $month]);        
        }

        $mid = Issue::where('id', $id)->get()->first();
        $cur_day = \Carbon\Carbon::now();

        $ret = new Returnreport;
        $ret->book_id = $mid->book_id;
        $ret->member_id = $mid->member_id;
        $ret->issue_users = $mid->users_name;
        $ret->return_users = $user;
        $ret->issueDate = $mid->issueDate;
        $ret->retDate = $cur_day;
        $ret->save();

        Issue::destroy($id);
      }

      $arr['return'] = Issue::all();
      $res = DB::select('select id from issues where member_id = ?', [$mid->member_id]);

      
       return redirect()->route('return')->with('success', 'All books have been returned.');

    }

    public function retBooksonly($id)
    {
      $b = Issue::where('book_id', $id)->get()->first();
      $mem_id = $b->member_id;
      $user = auth()->user()->name;

      DB::delete('delete from book_member WHERE book_id = ? AND member_id =?', [$b->book_id, $b->member_id]);

      DB::update('update books set qty = ?, member_id = ?, issuer = ?, upload = ? where id = ?', [1,0,NULL,1,$b->book_id]);

      $year = date("Y");
      $month = date("m");
 
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
        
        DB::update('update registers set ret = ? where year =? and month = ?', [$no, $year, $month]);
       
      }
      elseif (count($check_year) > 0 && count($check_month) == 0) {
        //insert only month and nos
        $ins = new Register;
        $ins->year = $year;
        $ins->month = $month;
        $ins->ret = 1;
        $ins->save();
        
      }
      else
      {
        //update only nos.
        $nos = DB::select('select ret from registers where month = ? AND year = ?', [$month, $year]);
        $ret = $nos[0]->ret + 1;

        DB::update('update registers set ret= ? where year = ? and month = ?', [$ret, $year, $month]);        
      }

      $mid = Issue::where('book_id', $id)->get()->first();
      $cur_day = \Carbon\Carbon::now();

      $ret = new Returnreport;
      $ret->book_id = $mid->book_id;
      $ret->member_id = $mid->member_id;
      $ret->issue_users = $mid->users_name;
      $ret->return_users = $user;
      $ret->issueDate = $mid->issueDate;
      $ret->retDate = $cur_day;
      $ret->save();

      Issue::destroy($mid->id);

      $arr['return'] = Issue::all();
      $res = DB::select('select id from issues where member_id = ?', [$mid->member_id]);

      if(count($res) != 0)
      {
         return back()->with('success', 'Book have been returned.');
      }
      else
      {
       return redirect()->route('retBybook')->with('success', 'Book have been returned.');
       }  
    }

    public function receipt(Request $request)
    {   

      $ret_days = Issue::find($request->id);
      $ret = $ret_days->retDate;
      $last_day = \Carbon\Carbon::parse($ret);
      $cur_day = \Carbon\Carbon::now();
      $days = $last_day->diffInDays($cur_day);

      $rate = Setting::find(1);
      $rate_per_day = $rate->fees;
      $duration = $rate->fees_duration;

      $arr3['duration'] = $duration;
      $arr2['rate_per_day'] = $rate_per_day;
      $arr1['day'] = $days; 
      $arr['return'] = Issue::find($request->id);
      $memid = Members::where('id', $arr['return']->member_id)->get()->first();

      $max['max'] = Receipt::max('id');


      $amount['amount'] = $request->amount;
      $id['id'] = $max['max'] + 1;
      $book['book'] = $arr['return']->book->title;
      $member['member'] = $arr['return']->member->name;
      $memId['memId'] = $memid->id_number;

      $r = new Receipt;
      $r->book_id = $arr['return']->book_id;
      $r->member_id = $arr['return']->member_id;
      $r->noOfDays = $days;
      $r->receiptNo = $max['max'] + 1;
      $r->billDate = $cur_day;
      $r->save();

      $arr0['arr'] = array_merge($arr1, $arr2, $arr3, $id, $book, $member, $memId, $amount);
     
      // return view('return/receipt')->with($arr0);
      $pdf = PDF::loadView('return/receipt', $arr0);
      return $pdf->download('Receipt.pdf');
    }

     function action(Request $request)
    {
     $defaultAddress = Setting::find(1);

     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('members')
       	 ->join('issues', 'issues.member_id', '=', 'members.id')
       	 ->select('members.name as name', 'members.section', 'members.address', 'members.id', 'members.id_number as id_number')
       	 ->where('name', 'like', '%'.$query.'%')
         ->orWhere('id_number', 'like', '%'.$query.'%')
         ->distinct()
         ->get();
         
      }
      else
      {
       $data = DB::table('members')
         ->join('issues', 'issues.member_id', '=', 'members.id')
         ->select('members.name as name', 'members.section', 'members.address', 'members.id', 'members.id_number as id_number')
       	 ->distinct()
         ->orderBy('name', 'asc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {

        $address = !empty($row->address) ? $row->address.'<br>'.$defaultAddress->id_address_default : $defaultAddress->id_address_default;
        $section = !empty($row->section) ? $row->section : 'N/A';

        $output .= '
        <tr>
         <td>'.$row->name.' ('.$row->id_number.')</td>
         <td>'.$address.'</td>
         
         <td><a href="'. route ('returnBooks', $row->id) .'" class="btn btn-danger">Return Book</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Record Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

    public function encrypt(){
        $phrase = config('checkunauthority.passcode');
        $encrypted = Crypt::encryptString($phrase);
        
        return $encrypted;
    }

    function action1(Request $request)
    {

     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('books')
         ->join('issues', 'issues.book_id', '=', 'books.id')
         ->select('books.title as title', 'books.accessionno as accessionno', 'books.location as location', 'books.id as b_id')
         ->where('title', 'like', '%'.$query.'%')
         ->orWhere('accessionno', 'like', '%'.$query.'%')
         ->distinct()
         ->get();
         
      }
      else
      {
       $data = DB::table('books')
         ->join('issues', 'issues.book_id', '=', 'books.id')
         ->select('books.title as title', 'books.accessionno as accessionno', 'books.location as location', 'books.id as b_id')
         ->distinct()
         ->orderBy('title', 'asc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       { $i = 1;
        $output .= '
        <tr>
         <td>'.$row->title.'</td>
         <td>'.$row->accessionno.'</td>
         <td>'.$row->location.'</td>
         <td><a href="'. route ('returnbyBooks', $row->b_id) .'" class="btn btn-warning">Return Book</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Record Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
