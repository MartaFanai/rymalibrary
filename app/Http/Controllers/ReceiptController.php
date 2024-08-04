<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use Carbon\Carbon;

class ReceiptController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Delete receipts older than one year
        $oneYearAgo = Carbon::now()->subYear();
        Receipt::where('created_at', '<', $oneYearAgo)->delete();

    	$arr['receipt'] = Receipt::orderBy('receiptNo', 'DESC')->get(); 

    	return view('return/checkList')->with($arr);
    }
}
