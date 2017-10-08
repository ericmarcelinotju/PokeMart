<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function profile(){

    	$user = Auth::user();

    	return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request){

    	$user = User::find($request->id);

    	$this->validate($request, [
	        'email' => 'email|unique:users,email,'.$user->id,
	        'profile_picture' => 'image',
	        'gender' => 'required',
	        'dob' => 'date_format:Y-m-d|olderThan:10,Y-m-d',
            'address' => 'required|min:10'
	    ]);

	    $fileName = '';

	    if ($request->hasFile('profile_picture')) {
            $destinationPath = public_path('img/profile_picture');
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $fileName = uniqid().'.'.$extension;

            $request->file('profile_picture')->move($destinationPath, $fileName);
        }else{
        	$fileName = $user->profile_picture;
        }

    	$user->email = $request->email;
    	$user->profile_picture = $fileName;
    	$user->gender = $request->gender;
    	$user->dob = $request->dob;
    	$user->address = $request->address;
    	$user->save();

    	return back();
    }

    public function index(Request $request){

        $action = $request->action;
        $users = User::all();

        return view('user.admin.search', compact('action', 'users'));
    }

    public function update(Request $request){
        
        $user = User::find($request->id);

        return view('user.profile', compact('user'));
    }

    public function delete(Request $request){
        
        $user = User::find($request->id);

        $user->delete();

        return back();
    }
}
