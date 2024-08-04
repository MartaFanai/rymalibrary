<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;
use App\Setting;
use App\Members;
use App\Register;
use App\Issue;
use DB;
use Session;

class BarcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $arr['books'] = Book::with('author', 'publisher')->orderBy('title', 'ASC')->select('id', 'title', 'author_id', 'publisher_id', 'accessionno', 'edition', 'classificationno', 'subject', 'bookno')->get();
        // $arr['books'] = Book::orderBy('title', 'ASC')->get();
        
        return view('code.index')->with($arr);
    }

    public function barcodeposition(Request $request)
    {
       
        $arr['book'] = Book::find($request->id);

        return view('code.barcode_position')->with($arr);
    } 

    public function position(Request $request)
    {
        
        $position['position'] = $request->position;

        $arr['book'] = Book::find($request->id);

        return view('code.barcode')->with($arr)->with($position);
    }
 
    public function barcode(Request $request)
    {
    	$arr['book'] = Book::find($request->id);

    	return view('code.barcode')->with($arr);
    }

    public function qrcode(Request $request)
    {
    	$arr['book'] = Book::find($request->id);

    	return view('code.qrcode')->with($arr);
    }

    public function range(Request $request)
    {
        $arr['book'] = Book::find($request->id);

        return view('code.range')->with($arr);
    }

    public function rangeList(Request $request)
    {
        $arr0['verify'] = Book::where('accessionno', $request->accessionNo)->get();
        $nos = Setting::find(1);

        if(count($arr0['verify']))
        {
            $arr['books'] = Book::whereRaw('CAST(accessionno AS SIGNED) >= ?', [$request->accessionNo])
                ->orderByRaw('CAST(accessionno AS SIGNED) ASC')
                ->take($nos->no_of_code_per_page)
                ->get();

            $arr1['name'] = DB::table('members')
                ->leftJoin('books', 'books.member_id', '=', 'members.id')
                ->select('members.name as name', 'members.id as mid')
                ->get();

            $arr2['book'] = DB::table('issues')
                ->leftJoin('books', 'books.id', '=', 'issues.book_id')
                ->select('issues.users_name as user')
                ->get();

            return view('code.bar_multi')->with($arr)->with($arr1)->with($arr2);
        }
        else
        {
            return redirect()->back()->with('toast_error', 'Accession No not found.');
        }
    }

    public function multibar()
    {
        $arr['books'] = Book::orderByRaw('accessionno + 0 asc')->get();
        $arr1['name'] = DB::table('members')
        ->leftJoin('books', 'books.member_id', '=', 'members.id')
        ->select('members.name as name', 'members.id as mid')
        ->get();
        $arr2['book'] = DB::table('issues')
        ->leftJoin('books', 'books.id', '=', 'issues.book_id')
        ->select('issues.users_name as user')
        ->get();
        return view('code.bar_multi')->with($arr)->with($arr1)->with($arr2);
    }

    public function rangeQR(Request $request)
    {
        $arr['book'] = Book::find($request->id);

        return view('code.rangeQR')->with($arr);
    }

    public function rangeQRList(Request $request)
    {
        $arr0['verify'] = Book::where('accessionno', $request->accessionNo)->get();

        $nos = Setting::find(1);

        if(count($arr0['verify']))
        {
            $arr['books'] = Book::whereRaw('CAST(accessionno AS SIGNED) >= ?', [$request->accessionNo])
                ->orderByRaw('CAST(accessionno AS SIGNED) ASC')
                ->take($nos->no_of_qrcode_per_page)
                ->get();

            $arr1['name'] = DB::table('members')
                ->leftJoin('books', 'books.member_id', '=', 'members.id')
                ->select('members.name as name', 'members.id as mid')
                ->get();

            $arr2['book'] = DB::table('issues')
                ->leftJoin('books', 'books.id', '=', 'issues.book_id')
                ->select('issues.users_name as user')
                ->get();

            return view('code.qr_multi')->with($arr)->with($arr1)->with($arr2);
        }
        else
        {
            return redirect()->back()->with('toast_error', 'Accession No not found.');
        }
    }

    public function multiqr()
    {
        $arr['books'] = Book::orderByRaw('accessionno + 0 asc')->get();
        $arr1['name'] = DB::table('members')
        ->leftJoin('books', 'books.member_id', '=', 'members.id')
        ->select('members.name as name', 'members.id as mid')
        ->get();
        $arr2['book'] = DB::table('issues')
        ->leftJoin('books', 'books.id', '=', 'issues.book_id')
        ->select('issues.users_name as user')
        ->get();
        return view('code.qr_multi')->with($arr)->with($arr1)->with($arr2);
    }

    public function multibarprint(Request $request)
    {
        $id = $request->printid;
        if(!empty($id))
            $nos = count($id);
        else
            $nos = 0;

        if($nos == 0)
            return redirect()->back()->with('toast_error', 'Select atleast one book from Select column.');
        else{
            $book['book'] = Book::whereIn('id', $id)->orderByRaw('CAST(accessionno AS SIGNED) ASC')->get();
            return view('code.print_barcode')->with($book);
        }
    }


    public function multiqrprint(Request $request)
    {
        $id = $request->printid;
        if(!empty($id))
            $nos = count($id);
        else
            $nos = 0;

        if($nos == 0)
            return redirect()->back()->with('toast_error', 'Select atleast one book from Select column.');
        else{
            $book['book'] = Book::whereIn('id', $id)->orderByRaw('CAST(accessionno AS SIGNED) ASC')->get();
            return view('code.print_qrcode')->with($book);
        }
    }
}
