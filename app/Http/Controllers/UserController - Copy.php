<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Validate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkId')->except('index', 'create');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['user'] = User::select('*')->where('name', '!=', 'supuser')->get();

        return view('user.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request, User $user)
    {
       $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]); 

       if ($validation->fails()) {
           return back()->with('warning', $validation->messages()->all()[0])->withInput();
        }

        if($request->name != $user->name)
        {
            $check = User::where('name', 'like', $request->name)->count();

            if($check)
                return back()->with('warning', 'User name already taken..!!! Please try with other name.')->withInput();
        }
        
        if(isset($request->image) && $request->image->getClientOriginalName())
        {
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;
                $request->image->storeAs('storage/users',$file);
        }
        else
        {
            if(!$user->image)
                $file = 'unknown.jpg';
            else
                $file = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->image = $file;
        $user->save();

        return redirect()->route('users.index')->with('toast_success', 'New user added successfully.');
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


    public function saveCroppedImage(Request $request)
    {
        $image = $request->input('croppedImages');
        $filename = $request->input('newFileNames');
        $filePath = 'picture/' . $filename;

        // Remove the base64 prefix from the cropped image data
        $imageData = str_replace('data:image/jpeg;base64,', '', $image);

        // Create the Picture directory if it doesn't exist
        $directory = dirname(storage_path('app/' . $filePath));
        // $directory = dirname(storage_path('app/' . str_replace('\\', '/', $filePath)));

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 777, true, true);
        }

        // Convert the base64 data to binary and save it to the storage/app/Picture directory
        Storage::disk('local')->put($filePath, base64_decode($imageData));

        // Return the filename of the saved image to update the file input field
        return response()->json(['success' => true, 'filename' => $filePath]);
    
    }

    public function saveCroppedImage1(Request $request)
    {
        $image = $request->input('croppedImage');
        $filename = $request->input('newFileName');
        $filePath = 'picture/' . $filename;

        // Remove the base64 prefix from the cropped image data
        $imageData = str_replace('data:image/jpeg;base64,', '', $image);

        // Create the Picture directory if it doesn't exist
        $directory = dirname(storage_path('app/' . $filePath));

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 777, true);
        }

        // Convert the base64 data to binary and save it to the storage/app/Picture directory
        Storage::disk('local')->put($filePath, base64_decode($imageData));

        // Return the filename of the saved image to update the file input field
        return response()->json(['success' => true, 'filename' => $filePath]);
    
    }


    public function profile($id)
    {
        return $id <= 1 ? redirect()->back() : view('user.profile')->with(['user' => User::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr['user'] = User::find($id); 
        return view('user.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]); 

       if ($validation->fails()) {
           return back()->with('warning', $validation->messages()->all()[0])->withInput();
        }
        
        if($request->name != $user->name)
        {
            $check = User::where('name', 'like', $request->name)->count();

            if($check)
                return back()->with('warning', 'User name already taken..!!! Please try with other name.')->withInput();
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null && strlen($request->password) > 0)
        {
            $user->password = Hash::make($request->password);
        }
        

        $image_name = $user->image;
    
         if(isset($request->image) && $request->image->getClientOriginalName())
            {
                
                $ext = $request->image->getClientOriginalExtension();
                $file = date('YmdHis').rand(1,99999).'.'.$ext;

                    $filename = '1'.$request->image->getClientOriginalName();
                    $picturePath = storage_path('app/picture/' . $filename);
                    $usersPath = storage_path('app/public/users/' . $filename);

                    if (File::exists($picturePath)) {
                       File::move($picturePath, $usersPath);
                       Storage::move('public/users/' . $filename, 'public/users/' . $file);
                    } else {
                        $request->image->move('storage/users',$file);
                    }

                

                if($image_name != "unknown.jpg")
                {
                    $image_exist = "storage/users/".$image_name;
                    unlink($image_exist);
                }
            }
            else
            {
                if(!$user->image)
                    $file = 'unknown.jpg';
                else
                    $file = $user->image;
            }
        
       
        $user->image = $file;
        $user->save();
        return back()->with('toast_success', 'Update user details successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = User::find($id);
        if($image->image != 'unknown.jpg'){
            $image_loc = "storage/users/".$image->image;
            unlink($image_loc);    
        }
      User::destroy($id);
      return redirect()->route('users.index')->with('toast_warning', 'Delete 1 user from system.');
    }
}
