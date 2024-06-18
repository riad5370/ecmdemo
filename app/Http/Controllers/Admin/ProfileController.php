<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        return view('admin.profile.update_profile');
    }

    public function infoUpdate(Request $request){
        if ($request->image == ''){
            User::find(Auth()->user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
            ]);
            return back()->with('success','profile updated!');
        }
        else{
            $photo = Auth()->user()->image;
            if ($photo == null){
               $image = $request->image;
               $extension = $image->getClientOriginalExtension();
               $imageName = Auth()->user()->id.'.'.$extension;
               $img = $image->move(public_path('/images/user/'), $imageName);;
               User::find(Auth()->user()->id)->update([
                   'name'=>$request->name,
                   'email'=>$request->email,
                   'image'=>$imageName,
                   'phone'=>$request->phone,
               ]);
               return back()->with('success','profile updated!');
            }
            else{
                $delete_form = public_path('images/user/'.$photo);
                unlink($delete_form);

                $image = $request->image;
                $extension = $image->getClientOriginalExtension();
                $imageName = Auth()->user()->id.'.'.$extension;
                $img = $image->move(public_path('/images/user/'), $imageName);

                User::find(Auth()->user()->id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'image'=>$imageName,
                    'phone'=>$request->phone,
                    
                ]);
                return back()->with('success','profile updated!');
            }
        }
    }

    public function passwordUpdate(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);
        if(Hash::check($request->old_password, Auth()->user()->password)){
            User::find(Auth()->user()->id)->update([
               'password'=>bcrypt($request->password)
            ]);
            return back()->with('password','password updated');
        }
        else{
            return back()->with('failed','Your old password not match!');
        }
    }
}

