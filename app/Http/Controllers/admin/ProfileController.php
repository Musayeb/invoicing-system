<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Clients;
use App\Models\Projects;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\activityLogs;
use Helper;


class ProfileController extends Controller
{
    public function index()
    {
        $user=User::find(Auth::id());
        return view('admin.userManagement.profile',compact('user'));
    }

    public function ChangePassword(Request $request)
    {
        $valid=$request->validate([
            'old_password'=>'required|min:8',
            'user_password'=>'required|min:8',
            'password_confirm'=>'required|same:user_password',
        ]);

        if($valid)
        {
            Helper::addActivityLog('user change his password');

            $user=User::find($request->reset_password_id);
            if (Hash::check($request->old_password, $user->password)) { 
                $user->fill([
                'password' => Hash::make($request->user_password)
                ])->save();
                return response()->json('success'); 
            } else {
                return response()->json('error'); 
            }
        }
    }


    public function ChangePhoto(Request $request){
        if(!empty($request->user_photo)){
            $valid=$request->validate([
                'user_photo'=>'required|mimes:jpeg,bmp,png|max:500',
            ]);
           if($valid){

                 Helper::addActivityLog('user change his photo');
                $path=Storage::putFile('user-img',$request->file('user_photo'));
                $user=User::find($request->hidden_id);
                $user->profile_photo_path=$path;
                $user->save();
                return  response()->json(['success'=>'Profile Picture update successfully']);
           }
        }else{
            return  response()->json(['success'=>'Profile Picture update successfully']);
        }
        
    }




}





















// $password= Hash::make($request->user_password);
            // $user=User::find($request->reset_password_id);
            // $user->password=$password;
            // $user->save();