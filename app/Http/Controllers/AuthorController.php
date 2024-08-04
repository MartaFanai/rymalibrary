<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AuthorsImport;
use App\Exports\AuthorsExport;

use Illuminate\Http\Request;
use App\Author;
use App\Record;
use App\Book;
use Throwable;

class AuthorController extends Controller
{
    public function index()
    {
        $arr['authors'] = Author::orderBy('name')->get();
        $arr1['sync'] = Book::where('author_id', 0)->count();

        return view('author.index')->with($arr)->with($arr1);
    }

    public function create()
    {
        return view('author.create');
    }

    public function store(Request $request)
    {
        $author = Author::firstOrCreate(['name' => $request->name]);

        if ($author->wasRecentlyCreated) {
            // Author was just created
            return redirect()->route('authors.index')->with('toast_success', 'New Author Created');
        } else {
            // Author already existed
            return redirect()->route('authors.index')->with('toast_info', 'Author Already Exists');
        }
    }

    public function edit()
    {
        $arr['authors'] = Author::orderBy('name')->get()->first();

        return view('author.edit')->with($arr);
    }

    public function update(Request $request, $id)
    {
        $check = Author::where('name', $request->name)->whereNotIn('id', [$id])->count();

        if(!$check)
        {
            Author::find($id)->update(['name' => $request->name]);
        }
        else
        {
            return back()->with('toast_error', 'Author name already exist');
        }

        return redirect()->route('authors.index')->with('toast_success', 'Author Updated Successfully.');
    }

    public function importAuthor()
    {
        return view('author.uploadAuthors');
    }

    public function uploadAuthor(Request $request)
    {
        try{
            Excel::import(new AuthorsImport, $request->file('author'));
            
            return redirect()->route('authors.import')->with('success', 'Uploaded successfully!');
        }catch (Throwable $e) {
            
            return redirect()->route('authors.import')->with('warning', 'Failed to upload, check source file format, heading, etc.');
        }
    }

    public function exportAuthor()
    {
        return Excel::download(new AuthorsExport, 'authors.csv', \Maatwebsite\Excel\Excel::CSV, ['X-Vapor-Base64-Encode' => 'True']);
    }

    public function authorSync()
    {
        $booksToUpdate = Book::where('author_id', 0)->get();
        $process = 0;
        foreach ($booksToUpdate as $book) {
            $authorId = Author::where('name', $book->author)->pluck('id')->first();
            
            if ($authorId) {
                Book::find($book->id)->update(['author_id' => $authorId]);
                $process = 1;
            }
        }

        if($process)
            return back()->with('success', 'Author sync completed');
        else
            return back()->with('info', 'Nothing to sync');
    }

    public function destroy($id)
    {
        $search = Book::where('author_id', $id)->count();
        $author = Author::find($id);

        if($search)
        {
            return back()->with('toast_info', 'The author '.$author->name.' is still linked to '.$search.' books.');
        }
        else
        {
            Author::find($id)->delete();
            
            //Delete data from most borrowed book list also
            if (Record::where('author_id', $id)->exists()) {
                Record::where('author_id', $id)->delete();
            }
        }

        return back()->with('toast_success', 'Author is deleted.');
    }
}
