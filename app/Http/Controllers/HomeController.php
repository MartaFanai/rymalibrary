<?php
namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BooksImport;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Issue;
use App\Register;
use App\Task;
use App\Members;
use App\Record;
use App\Stat;
use DB;
use View;
use Throwable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $year = date("Y");
        $month = date("m");

        $oldYear1 = Register::where('id', 1)->get()->first();

        //Record Yearly Statistics
        $checkStat = Stat::all();

        if(!$checkStat->count() || $checkStat->last()->year != $year)
        {
            $stat = new Stat;
            $stat->year = $year;
            $stat->save();
        }

        //Adding new years
        if(is_null($oldYear1))
        {
            for($i=1; $i <= 12; $i++)
            {
                $month = sprintf('%02d', $i);
                Register::create(['year' => $year, 'month' => $month]);
            }
        }

        $oldYear = Register::where('id', 1)->get()->first();
        
        if($year > $oldYear->year)
        {
            $oldTot = Register::where('year', $oldYear->year)->where('month', 12)->get()->first();
            
            DB::update('update registers set tot_book = ?, year = ?, issue = ?, ret = ?  where id = ?', [$oldTot->tot_book, $year, 0, 0, 1]);
            for ($i=2; $i < 13; $i++) { 
                DB::update('update registers set tot_book = ?, year =?, issue = ?, ret = ? where id = ?', [0, $year, 0, 0, $i]);
            }
        }
        
        $oldValue = Register::where('year', $year)->where('month', $month)->get()->first();
        
        //Checking for month with registers
        
        if($month == '01' && $year == $oldValue->year)
        {
            $newMonth = '01';
            $value = 0;
        }
        elseif($month == '02' && $year == $oldValue->year)
        {
            $newMonth = '01';
            $value = $oldValue->tot_book;
        }
        elseif($month == '03' && $year == $oldValue->year)
        {
            $newMonth = '02';
            $value = $oldValue->tot_book;
        }
        elseif($month == '04' && $year == $oldValue->year)
        {
            $newMonth = '03';
            $value = $oldValue->tot_book;
        }
        elseif($month == '05' && $year == $oldValue->year)
        {
            $newMonth = '04';
            $value = $oldValue->tot_book;
        }
        elseif($month == '06' && $year == $oldValue->year)
        {
            $newMonth = '05';
            $value = $oldValue->tot_book;
        }
        elseif($month == '07' && $year == $oldValue->year)
        {
            $newMonth = '06';
            $value = $oldValue->tot_book;
        }
        elseif($month == '08' && $year == $oldValue->year)
        {
            $newMonth = '07';
            $value = $oldValue->tot_book;
        }
        elseif($month == '09')
        {
            $newMonth = '08';
            $value = $oldValue->tot_book;
        }
        elseif($month == '10' && $year == $oldValue->year)
        {
            $newMonth = '09';
            $value = $oldValue->tot_book;
        }
        elseif($month == '11' && $year == $oldValue->year)
        { 
            $newMonth = '10';
            $value = $oldValue->tot_book;
        }
        elseif($month == '12' && $year == $oldValue->year)
        {
            $newMonth = '11';
            $value = $oldValue->tot_book;
        }

        $verify = Register::where('year', $year)->where('month', $newMonth)->get()->first();

        if($oldValue->tot_book == 0)
        {
             DB::update('update registers set tot_book = ? where year =? and month = ?', [$verify->tot_book, $year, $month]);
        }


        //Update in every login
        $today = Carbon::today();
        $statUpdated = Stat::whereDate('updated_at', $today)->get()->first();
        $syncStat = 0;

        if(is_null($statUpdated))
            {

                $tot_issue = Register::sum('issue');
                $tot_return = Register::sum('ret');
                $tot_books = Register::where('month', $month)->get()->first();

                //update to Stat table
                Stat::where('year', $year)->update(['issue' => $tot_issue, 'ret' => $tot_return, 'tot_book' => $tot_books->tot_book]);

                $statUpdated = Stat::whereDate('updated_at', $today)->get()->first();
            }

        if($statUpdated->count())
        {
            $tot_issue = Register::sum('issue');
            $tot_return = Register::sum('ret');
            $tot_books = Register::where('month', $month)->get()->first();

            $stat = Stat::where('id', $statUpdated->id)->where('issue', $tot_issue)->where('ret', $tot_return)->where('tot_book', $tot_books->tot_book)->count();

            if(!$stat)
            {
                $syncStat = 1;
            }

            if($syncStat)
            {
                $tot_issue = Register::sum('issue');
                $tot_return = Register::sum('ret');
                $tot_books = Register::where('month', $month)->get()->first();

                //update to Stat table
                Stat::where('year', $year)->update(['issue' => $tot_issue, 'ret' => $tot_return, 'tot_book' => $tot_books->tot_book]);
            }

        }
        

        $data['data'] = DB::select('select issue, ret, tot_book from registers where year = ?', [$year]);
        $notRet['notRet'] = DB::select('SELECT * FROM issues');
        
        $arr['user'] = User::where('name', 'not like', 'supuser')->get()->count();
        $arr1['book'] = Book::where('id', '!=', 0)->get()->count();
        $arr2['task'] = Task::orderBy('id', 'desc')->get();
        $arr3['mem'] = Members::where('id', '!=', 0)->get()->count();
        $arr4['active'] = Members::where('year', '>=', $year)->get()->count();
        $arr5['inactive'] = Members::where('year', '<', $year)->get()->count();
        $arr6['record'] = Record::orderByDesc('borrow_count')->orderBy('title')->take(10)->get();


        return view('home')->with($arr)->with($arr1)->with($data)->with($arr2)->with($notRet)->with($arr3)->with($arr4)->with($arr5)->with($arr6);
    }

    public function backup() 
    {
        function removefile($folder){
            if(is_dir($folder) === true){
                $folderContents = scandir($folder);
                unset($folderContents[0], $folderContents[1]);
                foreach($folderContents as $content => $contentName){
                    $currentPath = $folder.'/'.$contentName;
                    $fileType = filetype($currentPath);
                    if($fileType == 'dir'){
                        removefile($currentPath);
                    }
                    else{
                        unlink($currentPath);
                    }
                    unset($folderContents[$content]);
                }
            
            }
        }

        removefile('../storage/app/backups/Marta-s-Library');
       

        \Artisan::call('backup:run', ['--disable-notifications' => true, '--only-db' => true]);

        
        // Set SweetAlert flash message
        Alert::success('Success', 'Database backup successfully!!!!');

        // Return JSON response
        return response()->json(['success' => true]);

        // return back()->with('success','Database back up successfully');
    }

    public function downloadBackup()
    {
        // Get the latest backup file
        $files = Storage::files('backups/Marta-s-Library');
        $latestFile = collect($files)->sort()->last();

        // Generate the download response
        return Storage::download($latestFile);
    }

    public function importBooks()
    {
        return view('book.uploadBooks');
    }

    public function uploadBooks(Request $request)
    {
        try {
            Excel::import(new BooksImport, $request->file('book'));
            
            return redirect()->route('import')->with('success', 'Uploaded successfully!');
        } catch (Throwable $e) {
            
            return redirect()->route('import')->with('warning', 'Failed to upload, check source data format, heading, etc.');
        }
    }

    public function downloadFormat()
    {
        $filename = 'lehkhabu.xlsx';
        $path = Storage::path('public\file\\'. $filename);

        $response = Response::download($path);

        return $response;
    }

    public function localbackup()
    {
        return view('localbackup')->with('success','Database back up successfully');
    }

    public function backupredirect()
    {
        return redirect()->route('home')->with('success','Database back up successfully');
    }
}
