<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Projects;
use App\Models\Clients;
use App\Models\Notifications;


class NotificationsController extends Controller
{
    public function index()
    {

        $change_status=Notifications::where('status','noview')->get();
        foreach($change_status as $row){
            $change=Notifications::find($row->id);
            $change->status="unread";
            $change->save();
        }

        $count_unread=Notifications::Where('status','noview')->orWhere('status','unread')->count();
        $notifications=Notifications::orderBy('created_at','DESC')->get();
        return view('admin.notifications.index',compact('notifications','count_unread'));
    }

    public function edit($id)
    {
        $notification=Notifications::find($id);
        $notification->status="read";
        $notification->save();
        return response()->json(['success'=>'Read Notification']); 
    }

    public function ReadAll(){
        $change_status=Notifications::where('status','noview')->orwhere('status','unread')->get();
        foreach($change_status as $row){
            $change=Notifications::find($row->id);
            $change->status="read";
            $change->save();
        }
        return response()->json(['success'=>'Read Notification']);
    }
}
