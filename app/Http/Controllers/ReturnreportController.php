<?php

namespace App\Http\Controllers;

use App\Returnreport;
use App\Book;
use App\Members;
use App\Issue;
use Illuminate\Http\Request;

class ReturnreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['report'] = Returnreport::select('id', 'book_id', 'member_id', 'issue_users', 'return_users', 'issueDate', 'retDate')->orderBy('retDate', 'DESC')->get();
        
        return view('return_report/index')->with($arr);
    }

    public function retreport(Request $request)
    {
        $arr['report'] = Issue::select('id', 'book_id', 'member_id', 'users_name', 'issueDate', 'retDate')->orderBy('issueDate', 'ASC')->get();
        

        return view('return_report/noreturn')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\returnreport  $returnreport
     * @return \Illuminate\Http\Response
     */
    public function show(returnreport $returnreport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\returnreport  $returnreport
     * @return \Illuminate\Http\Response
     */
    public function edit(returnreport $returnreport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\returnreport  $returnreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, returnreport $returnreport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\returnreport  $returnreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnreport $returnreport)
    {
        //
    }
}
