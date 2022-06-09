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
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\activityLogs;
use Helper;

class UserController extends Controller
{
    
    public function index()
    {
        $users=User::orderBy('created_at','DESC')->get();
        return view('admin.userManagement.users',compact('users'));
    }

    public function store(Request $request)
    {
        $valid=$request->validate([
            'user_name'=>'required',
            'user_email'=>'required|email|unique:users,email',
            'user_password'=>'required|min:8',
            'password_confirm'=>'required|same:user_password',
            'user_role'=>'required'
        ]);
       if($valid){
            $password= Hash::make($request->user_password);
            if(empty($request->file('user_photo')))
            {
                Helper::addActivityLog('add new user');
                $user=new User();
                $user->name=$request->user_name;
                $user->email=$request->user_email;
                $user->password=$password;
                $user->role=$request->user_role;
                $user->email_verified_at=now();
                $user->save();
                return  response()->json(['success'=>'User added successfully']);
            }
            else
            {
                Helper::addActivityLog('add new user');
                $path=Storage::putFile('user-img',$request->file('user_photo'));
                $user=new User();
                $user->name=$request->user_name;
                $user->email=$request->user_email;
                $user->password=$password;
                $user->role=$request->user_role;
                $user->profile_photo_path=$path;
                $user->save();
                return  response()->json(['success'=>'User added successfully']);
            }
       }

    }

    public function edit($id)
    {
        $user=User::find($id);
        return Response()->json($user);  
    }

    public function update(Request $request)
    {
        
            $valid=$request->validate([
                'user_name'=>'required',
                'user_email'=>'required|email',
                'user_role'=>'required'
            ]);
            if($valid)
            {
                Helper::addActivityLog('update user');
                $user=User::find($request->hidden_id);
                $user->name=$request->user_name;
                $user->email=$request->user_email;
                $user->role=$request->user_role;
                $user->save();
                return response()->json(['success'=>'User updated successfully']);  
            } 
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>'Record successfully deleted']);    
    }

    

    public function reset_password(Request $request)
    {
        $valid=$request->validate([
            'user_password'=>'required|min:8',
            'password_confirm'=>'required|same:user_password',
        ]);
        if($valid)
        {
            Helper::addActivityLog('reset user password');
            $password= Hash::make($request->user_password);
            $user=User::find($request->reset_password_id);
            $user->password=$password;
            $user->updated_at=now();
            $user->save();
            return  response()->json(['success'=>'Password reset successfully']);
        }
    }


}
