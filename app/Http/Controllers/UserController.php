<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        return view('frontend.index');
    } // end method

    public function UserProfile(){

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('userData'));

    } // end method

    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        //store image section
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo)); // fix delete old image
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Update user profile successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } // end method
}
