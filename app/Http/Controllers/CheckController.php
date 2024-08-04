<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\ReturnController;

class CheckController extends Controller
{
    public function check()
    {
    	return view('checking.login');
    }

    // public function encrypt(){

    //     $encrypted = Crypt::encryptString('library');
    //     return $encrypted;
    // }

    public function unauthorzed()
    {
        return view('admin.errors.400');
    }

    public function verify(Request $request)
    {
        $controller = new ReturnController;
    	$decrypt = $controller->encrypt();
    	$phrase = Crypt::decryptString($decrypt);

        if($request->password == $phrase)
    	{
    		return redirect()->route('register', ['code' => $request->password]);
    	}
    	else
    	{
    		return back()->with('toast_error', 'Passcode is not correct');
    	}
    }
}
