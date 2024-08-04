<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;
use App\UpdateBook;
use App\Members;
use App\Register;
use App\Issue;
use App\Returnreport;
use App\Receipt;
use App\Record;
use App\Author;
use App\Publisher;
use DB;
use Session;
 

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['books'] = Book::with('member', 'issue')->orderBy('title', 'ASC')->get();
        $arr1['name'] = DB::table('members')
        ->leftJoin('books', 'books.member_id', '=', 'members.id')
        ->select('members.name as name', 'members.id as mid')
        ->get();

        $arr2['book'] = DB::table('issues')
        ->leftJoin('books', 'books.id', '=', 'issues.book_id')
        ->select('issues.users_name as user')
        ->get();

        return view('book.index')->with($arr)->with($arr1)->with($arr2);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['authors'] = Author::orderBy('name')->get();
        $arr1['publishers'] = Publisher::orderBy('name')->get();

        return view('book.create')->with($arr)->with($arr1);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            // 'edition' => 'required',
            'year' => 'required|min:4|max:4',
            'publisher' => 'required',
            'pages' => 'required',
            'accessionno' => 'unique:books, accessionno', 
            
            // 'subject' => 'required',
            // 'bookno' => 'required', 
            'description' => 'required',
            'price' => 'required', 
            // 'location' => 'required',
        ], [
            'author.required' => 'The author field is required.',
        ]);

        if ($validator->fails()) {
           return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        $n = $request->nos;
        $a = $request->accession;
        
        for($i = 0; $i < $n; $i++)
        {
            $check = Book::where('accessionno', $a)->get()->count();

            if($check != 0)
            {
               return back()->with('toast_error','Accession no : '.$a.' already exist.')->withInput();
            }
            $a++;
        }

          $year = date("Y");
          $month = date("m");

          $check_year = DB::select('select year from registers where year = ?', [$year]);
          $check_month = DB::select('select month from registers where month = ?', [$month]);
          

        $nos = $request->nos;
        $access = $request->accession;

        //Check and assign correct author id and name
        $authorCheck = $request->input('author');

        if(is_numeric($authorCheck))
        {
            $authorId = $authorCheck;
            $author = Author::where('id', $authorCheck)->get()->pluck('name')->first();
        }
        else
        {
            $exist = Author::where('name', $authorCheck)->get()->count();

            if($exist)
                return back()->with('warning', 'Author name exist. Please select from dropdown.')->withInput();

            $newAuthor = Author::create(['name' => $authorCheck]);

            $authorId = $newAuthor->id;
            $author = $authorCheck;
        }

        //Check and assign correct publisher id and name
        $publisherCheck = $request->input('publisher');

        if(is_numeric($publisherCheck))
        {
            $publisherId = $publisherCheck;
            $publisher = Publisher::where('id', $publisherCheck)->get()->pluck('name')->first();
        }
        else
        {
            $exist = Publisher::where('name', $publisherCheck)->get()->count();

            if($exist)
                return back()->with('warning', 'Publisher name exist. Please select from dropdown.')->withInput();

            $newPublisher = Publisher::create(['name' => $publisherCheck]);

            $publisherId = $newPublisher->id;
            $publisher = $publisherCheck;
        }
       
        for($i = 0; $i < $nos; $i++)
        {
            $data = array(
            'title' => $request->title,
            // 'authorname' => $author,
            'author_id' => $authorId,
            'edition' => $request->edition,
            'volume' => $request->volume,
            'year' => $request->year,
            // 'publishername' => $publisher,
            'publisher_id' => $publisherId,
            'pages' => $request->pages,
            'accessionno' => $access + $i,
            'classificationno' => $request->classification,
            'subject' => $request->subject,
            'bookno' => $request->bookno,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'created_at' => now(),
            'updated_at' => now() 
            );
            $insert_data[] = $data;
        }

        Book::insert($insert_data);

          //Record entry for Register table        
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

            $total = Register::where('year', $year)->where('month', $month)->get()->first();
            $no = $total->tot_book + $request->nos;
            
            DB::update('update registers set tot_book = ? where year =? and month = ?', [$no, $year, $month]);
           
          }
          else
          {
            //update only nos.
            $total = Register::where('year', $year)->where('month', $month)->get()->first();
            $iss = $total->tot_book + $request->nos;

            DB::update('update registers set tot_book = ? where year = ? and month = ?', [$iss, $year, $month]);        
          }

        return redirect()->route('books.index')->with('toast_success','Book added successfully');
    }

    public function viewallbook()
    {
        $arr['books'] = Book::with('member', 'issue', 'author')
                        ->orderBy('title', 'ASC')
                        ->get();

        $arr['name'] = DB::table('members')
                        ->leftJoin('books', 'books.member_id', '=', 'members.id')
                        ->select('members.name as name', 'members.id as mid')
                        ->get();

        $arr['book'] = DB::table('issues')
                        ->leftJoin('books', 'books.id', '=', 'issues.book_id')
                        ->select('issues.users_name as user')
                        ->get();


        return view('book.viewbook')->with($arr);
    }


    public function record()
    {
        $arr['record'] = Record::with('author')->orderByDesc('borrow_count')->orderBy('title')->get();

        return view('book.recordList')->with($arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function livesearch(Request $request)
    {

    if ($request->has('input')) {
            $input = request()->input('input');

            $books = Book::with('author')
            ->where('title', 'LIKE', '%'. $input . '%')
            ->orWhereHas('author', function ($query) use ($input) {
                $query->where('name', 'LIKE', '%' . $input . '%');
            })
            ->orderBy('id')
            ->get();
           
            $sl = 1;

            if ($books->count() > 0) {
                echo '<h5 class="text-primary text-center text-bold">Books Found : '. $books->count() .'</h5>';
                echo '<table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>S/n</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($books as $row) {
                    echo '<tr>
                            <td>' . $sl++ . '</td>
                            <td>' . $row->title . '</td>
                            <td>' . $row->author->name . '</td>
                            <td>' . ($row->qty == 1 ? "Available" : "<font style='color:red;'>Borrowed</font>") . '</td>
                            <td><a href="' . route('viewbook.detail', ['id' => $row->id]) . '" class="btn btn-warning"><i class="fas fa-list"></i></a>
                                <a href="' . route('books.edit', ['book' => $row->id]) . '" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <a href="#myModal" class="btn btn-danger" data-id="'. $row->id .'" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>';
                }

                echo '</tbody></table>';
            } else {
                echo "<h6 class='text-danger text-center mt-3'>I lehkhabu zawn a awm lo</h6>";
            }
        }

    }


    public function viewallbookDetail(Request $request)
    {
        $arr['book'] = Book::where('id', $request->id)->first();

        $arr1['borrow'] = Issue::where('book_id', $request->id)->first();

        return view('book.viewbookDetail')->with($arr)->with($arr1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $arr['book'] = $book;
        $arr['authors'] = Author::orderBy('name')->get();
        $arr['publishers'] = Publisher::orderBy('name')->get();

        return view('book.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'bookno' => 'required', 
        ]);
        if ($validator->fails()) {
           return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        //Checking for existing accession no
        // dd($request->input('accession'));
        $exist = Book::where('accessionno', $request->input('accession'))->whereNotIn('id', [$book->id])->count();

        if($exist){
            return back()->with('info', 'Your new accession number assignment is already exist.')->withInput();
        }

        //Checking for author name and id
        $authorCheck = $request->input('author');

        if(is_numeric($authorCheck))
        {
            $authorId = $authorCheck;
            $author = Author::where('id', $authorCheck)->get()->pluck('name')->first();
        }

        //Checking for publisher name and id
        $publisherCheck = $request->input('publisher');

        if(is_numeric($publisherCheck))
        {
            $publisherId = $publisherCheck;
            $publisher = Publisher::where('id', $publisherCheck)->get()->pluck('name')->first();
        }
        
        $book->title = $request->title;
        // $book->authorname = $author;
        $book->author_id = $authorId;
        $book->edition = $request->edition;
        $book->volume = $request->volume;
        $book->year = $request->year;
        // $book->publishername = $publisher;
        $book->publisher_id = $publisherId;
        $book->pages = $request->pages;
        $book->accessionno = $request->accession;
        $book->classificationno = $request->classification;
        $book->subject = $request->subject;
        $book->bookno = $request->bookno;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->location = $request->location;
        $book->upload = 1;
        $book->save();
        return redirect()->route('books.index')->with('toast_success', 'Updated book details successfully');
    }

    public function exportBooks()
    {
        return Excel::download(new BooksExport, 'books.csv', \Maatwebsite\Excel\Excel::CSV, ['X-Vapor-Base64-Encode' => 'True']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deleteBook($id)
    {
        echo $id;
    }

    public function destroy($id)
    {
            $check = Issue::where('book_id', $id)->get();
            if(count($check) != 0)
            {
                return redirect()->route('books.index')->with('toast_error', 'This book is still borrowed. Cannot DELETE.');
            }                           

        $count = Book::where('id', $id)->count();
        $query = Book::where('id', $id)->first();
        if($count != 0)
        {
            $ins = new UpdateBook;

            $ins->bookid = $query->id;
            $ins->title = $query->title;
            $ins->author = $query->author->name;
            $ins->edition = $query->edition;
            $ins->volume = $query->volume;
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
            $ins->del = 1;
            $ins->created_at = $query->created_at;
            $ins->updated_at = $query->updated_at;

            $ins->save();
        }

        Book::destroy($id);

            $b_mth = DB::select('select MONTH(created_at) as month from books WHERE id = ?', [$id]);

            $b_yr = DB::select('select YEAR(created_at) as year from books WHERE id = ?', [$id]);
            
            // Changes Made in this code
            $nos = DB::select('select tot_book from registers where year = ? and month = ?', [ date('Y'), date('m')]);

            $iss = $nos[0]->tot_book - 1;

            // Changes Made in this code
            DB::update('update registers set tot_book = ? where year = ? and month = ?', [$iss, date('Y'), date('m')]); 

            $report = Returnreport::where('book_id', $id)->get();
            if(count($report) != 0)
            {
                DB::table('returnreports')->where('book_id', $id)->delete();
            }

            $recipt = Receipt::where('book_id', $id)->get();
            if(count($recipt) != 0)
            {
                DB::table('receipts')->where('book_id', $id)->delete();
            } 

        return back()->with('toast_error', 'Deleted book from your system');
    }
}
