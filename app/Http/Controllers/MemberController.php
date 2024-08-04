<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Toaster;
use App\Members;
use App\Issue;
use App\Returnreport;
use App\Receipt;
use App\Setting;
use DB;

class MemberController extends Controller
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
        $arr['member'] = Members::orderBy('name', 'ASC')->get();
        $arr['setting'] = Setting::find(1);

        return view('member.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = date('Y');

        $member['member'] = Members::whereYear('created_at', $year)->count();
        $arr['setting'] = Setting::find(1);
        
        if($member['member'] > 0)
        {
            $max['max'] = Members::where('year', $year)->select(DB::raw('MAX(CAST(rid AS UNSIGNED)) as max_rid'))->first();
            $max['max'] = $max['max']->max_rid;
        } 
        else
        {
            $max['max'] = 0;
        }

       // dd($max['max']);
        return view('member.create')->with($max)->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */ 
    public function store(Request $request, Members $member)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
           return back()->with('error', $validator->messages()->all()[0])->withInput();
        }


        if(isset($request->image) && $request->image->getClientOriginalName())
        {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;

                    $filename = '1'.$request->image->getClientOriginalName();
                    $picturePath = storage_path('app/picture/' . $filename);
                    $usersPath = storage_path('app/public/members/' . $filename);

                    if (File::exists($picturePath)) {
                       File::move($picturePath, $usersPath);
                       Storage::move('public/members/' . $filename, 'public/members/' . $file);
                    } else {
                        $request->image->move('storage/members',$file);
                    }
        }
        else
        {
            if(!$member->image) 
                $file = 'unknown.jpg';
            else
                $file = $member->image;
        }

        $member->year = $request->year;
        $member->name = $request->name;
        $member->relation = $request->relation;
        $member->relationname = $request->relationName;
        $member->gender = $request->gender;
        $member->section = $request->section;
        $member->mobile = $request->mobile;
        $member->address = $request->address;
        $member->image = $file;
        $member->id_number = $request->id_number;
        $member->rid = $request->rid;
        $member->save();
        return redirect()->route('members.index')->with('toast_success', 'New member added successfully.');
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

    public function generateid()
    {
        $valid = date('Y');
        $arr['generateid'] = Members::where('year', '>=', $valid)->orderBy('name', 'ASC')->get();
        $arr['setting'] = Setting::find(1);

        return view('member.generateid')->with($arr);
    }

    public function image()
    {
        return view('member.save-capture');
    }

    public function generateidnow($id)
    {
        $arr['member'] = Members::find($id);
        $arr['address'] = Setting::find(1);

        return view('member.id')->with($arr); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Members $member)
    {
        $arr['member'] = $member;
        return view('member.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Members $member)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
           return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        $member->name = $request->name;
        $member->relation = $request->relation;
        $member->relationname = $request->relationName;
        $member->gender = $request->gender;
        $member->section = $request->section;
        $member->mobile = $request->mobile;
        $member->address = $request->address;
        $member->id_number = $request->id_number;
        $member->rating = $request->rating;
        if($member->rating != 0)
        {
            $member->rating_user = auth()->user()->name;
        }
        else
        {
            $member->rating_user = NULL;
        }
          
        $image_name = $member->image;
    
         if(isset($request->image) && $request->image->getClientOriginalName())
            {
                
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;

                    $filename = '1'.$request->image->getClientOriginalName();
                    $picturePath = storage_path('app/picture/' . $filename);
                    $usersPath = storage_path('app/public/members/' . $filename);

                    if (File::exists($picturePath)) {
                       File::move($picturePath, $usersPath);
                       Storage::move('public/members/' . $filename, 'public/members/' . $file);
                    } else {
                        $request->image->move('storage/members',$file);
                    }

                

                if($image_name != "unknown.jpg")
                {
                    $image_exist = "storage/members/".$image_name;
                    unlink($image_exist);
                }
            }
            else
            {
                if($request->image == 'unknown.jpg')
                    $file = 'unknown.jpg';
                else
                    $file = $member->image;
            }
        
       
        $member->image = $file;
        $member->save();
        return redirect()->route('members.index')->with('toast_success', 'Update member details successfully');
    }

    public function validity($id)
    {
        $arr['member'] = Members::find($id);

        return view('member.validity')->with($arr);
    }

    public function updateValidity(Request $request, $id)
    {
        $newValidity = $request->years + $request->membershipExtension;

        Members::where('id', $id)->update(['year' => $newValidity]);

        return redirect()->route('members.edit', $id)->with('toast_success', 'Update member validity successful');
    }

    public function ratings()
    {
        $arr['rating'] = Members::orderBy('rating', 'DESC')->orderBy('name')->get();
        $arr['setting'] = Setting::find(1);

        return view('member.rating')->with($arr);
    }

    public function inactive()
    {
        
        $valid = date('Y');
        $arr['inactive'] = Members::where('year', '<', $valid)->orderBy('name', 'ASC')->get();

        return view('member.inactive')->with($arr);
    }

    public function activate(Request $request)
    {
        $valid = date('Y');
        
        Members::where('id', $request->id)->update(["year" => $valid]);

        return redirect()->route('inactive', 1)->with('success', 'Renew Membership successfully');
    }

    public function deactivate()
    {
        $valid = date('Y');
        $arr['members'] = Members::where('year', '>=', $valid)->orderBy('name', 'ASC')->get();

        return view('member.deactivate')->with($arr);
    }

    public function deactivateMember(Request $request)
    {
        $invalid = date('Y') - 1;
        Members::find($request->route('id'))->update(['year' => $invalid]);

        return back()->with('success', 'Deactivation of membership successful.');
    }

    public function record(Request $request)
    {
        $arr['report'] = Returnreport::where('member_id', $request->id)->orderBy('issueDate', 'DESC')->get();
        $arr1['member'] = Members::find($request->id);

        return view('member.report')->with($arr)->with($arr1);
    }

    public function notReturn(Request $request)
    {
        $arr['report'] = Issue::where('member_id', $request->id)->orderBy('issueDate', 'ASC')->get();
        $arr1['member'] = Members::find($request->id);

        return view('member.notReturn')->with($arr)->with($arr1);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iss = Issue::where('member_id', $id)->get();
        if(count($iss) != 0)
        {
            return redirect()->route('members.index')->with('toast_error', 'This member still needs to return some books.');
        }
        
        $image = Members::find($id);
        if($image->image != 'unknown.jpg'){
            $image_loc = "storage/members/".$image->image;
            unlink($image_loc);    
        }

        $report = Returnreport::where('member_id', $id)->get();
        if(count($report) != 0)
        {
            DB::table('returnreports')->where('member_id', $id)->delete();
        }

        $receipt = Receipt::where('member_id', $id)->get();
        if(count($receipt) != 0)
        {
            DB::table('receipts')->where('member_id', $id)->delete();
        }

        Members::destroy($id);
        return redirect()->route('members.index')->with('toast_warning', 'Delete 1 member from system.');
    }
}
