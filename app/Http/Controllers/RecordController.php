<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function statistics()
    {
        $arr['stat'] = Stat::orderBy('year', 'DESC')->get();

        return view('report.statistics')->with($arr);
    }
}
