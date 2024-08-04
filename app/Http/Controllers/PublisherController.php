<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PublishersImport;
use App\Exports\PublishersExport;

use Illuminate\Http\Request;
use App\Publisher;
use App\Book;
use Throwable;

class PublisherController extends Controller
{
    public function index()
    {
        $arr['publishers'] = Publisher::orderBy('name')->get();
        $arr1['sync'] = Book::where('publisher_id', 0)->count();

        return view('publisher.index')->with($arr)->with($arr1);
    }

    public function create()
    {
        return view('publisher.create');
    }

    public function store(Request $request)
    {
        $publisher = Publisher::firstOrCreate(['name' => $request->name]);

        if ($publisher->wasRecentlyCreated) {
            // Publisher was just created
            return redirect()->route('publishers.index')->with('toast_success', 'New Publisher Created');
        } else {
            // Publisher already existed
            return redirect()->route('publishers.index')->with('toast_info', 'Publisher Already Exists');
        }
    }

    public function edit()
    {
        $arr['publishers'] = Publisher::orderBy('name')->get()->first();

        return view('publisher.edit')->with($arr);
    }

    public function update(Request $request, $id)
    {
        $check = Publisher::where('name', $request->name)->whereNotIn('id', [$id])->count();

        if(!$check)
        {
            Publisher::find($id)->update(['name' => $request->name]);
        }
        else
        {
            return back()->with('toast_error', 'Publisher name already exist');
        }

        return redirect()->route('publishers.index')->with('toast_success', 'Publisher Updated Successfully.');
    }

    public function importPublisher()
    {
        return view('publisher.uploadPublishers');
    }

    public function uploadPublisher(Request $request)
    {
        try{
            Excel::import(new PublishersImport, $request->file('publisher'));
            
            return redirect()->route('publishers.index')->with('success', 'Uploaded successfully!');
        }catch (Throwable $e) {
            return redirect()->route('publishers.import')->with('warning', 'Failed to upload, check source file format, heading, etc.');
        }
    }

    public function exportPublisher()
    {
        return Excel::download(new PublishersExport, 'publishers.csv', \Maatwebsite\Excel\Excel::CSV, ['X-Vapor-Base64-Encode' => 'True']);
    }

    public function publisherSync()
    {
        $booksToUpdate = Book::where('publisher_id', 0)->get();
        $process = 0;
        foreach ($booksToUpdate as $book) {
            $publisherId = Publisher::where('name', $book->publisher)->pluck('id')->first();
           
            if ($publisherId) {
                Book::find($book->id)->update(['publisher_id' => $publisherId]);
                $process = 1;
            }
        }

        if($process)
            return back()->with('success', 'Publisher sync completed');
        else
            return back()->with('info', 'Nothing to sync with existing publishers');
    }

    public function destroy($id)
    {
        $search = Book::where('publisher_id', $id)->count();
        $publisher = Publisher::find($id);

        if($search)
        {
            return back()->with('toast_info', 'The publisher '.$publisher->name.' is still linked to '.$search.' books.');
        }
        else
        {
            Publisher::find($id)->delete();
        }

        return back()->with('toast_success', 'Publisher is deleted.');
    }
}
