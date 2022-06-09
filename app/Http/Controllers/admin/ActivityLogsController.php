<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Clients;
use App\Models\Projects;

use App\Models\activityLogs;
use Helper;


class ActivityLogsController extends Controller
{
    
    public function index()
    {
        $activityLog=activityLogs::orderBy('created_at','DESC')->get();
        return view('admin.userManagement.activityLog',compact('activityLog'));
    }


    public function accessRights(){
        $onlines=DB::table('sessions')->get();
        return view('admin.userManagement.accessRights',compact('onlines'));
    }

    public function destroy($id)
    {
        activityLogs::find($id)->delete();
        return response()->json(['success'=>'Record successfully deleted']);    
    }
    public function save()
    {
        # code...
    }
}
