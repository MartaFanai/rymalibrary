<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Members;
use App\Book;
use App\Issue;
use APP\Register;
use APP\Setting;
use DB;

class IssueController extends Controller
{
	
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$arr['issue'] = Members::all();
    	return view('issue/index')->with($arr);
    }

    function action(Request $request)
    {
     $valid = date('Y');
     $defaultAddress = Setting::find(1);
     
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('members')
         ->where('year', '>=', $valid)
         ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%'.$query.'%')
                         ->orWhere('id_number', 'like', '%'.$query.'%');
         })
         ->get();
         
      }
      else
      {
       $data = DB::table('members')
       ->where('year', '>=', $valid)
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
         
         <td><a href="'. route ('dynamic-field', $row->id) .'" class="btn btn-success">Issue Book</a></td>
        </tr>
        ';
       }
      }
      else 
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No record found.</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      return response()->json($data);
     }
    }

    function book_action(Request $request)
    {
    
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('books')
         ->where('title', 'like', '%'.$query.'%')
         ->get();
         
      }
      
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->title.'</td>
         <td>'.$row->description.'</td>
         <td>'.$row->author.'</td>
         <td><a href="'. route ('issue.member',$row->id) .'" class="btn btn-info">Add to Cart</a></td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
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

    public function list()
    {
    	$sql = "SELECT * FROM books WHERE title LIKE '%".$_GET['title']."%'";
 
    $result = $mysqli->query($sql);
 
    $response = [];
    while($row = mysqli_fetch_assoc($result)){
       $response[] = array("id"=>$row['id'], "name"=>$row['name']);
    }
 
    echo json_encode($response);
    }

    public function issue($id)
    {
    	$arr1['book'] = Book::all();
    	$arr['member'] = Members::find($id);
      
    	return view('issue/add')->with($arr)->with($arr1)->with('success', 'Book issued Successfully.');
    }

    public function add_issue(Request $request, Issue $issue)
    {
    	dd($request->skill);
    	dd($request->name);
    	
    }

}
