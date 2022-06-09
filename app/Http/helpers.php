   <?php

use App\Http\Controllers\admin\ActivityLogsController;
use App\Http\helpers as Helpers;
   use Composer\DependencyResolver\Request;
   use Illuminate\Support\Facades\DB;

  use App\Models\User;
  use App\Models\Projects;
  use App\Models\Clients;
  use App\Models\Invoice;


class Helper{
    
    // Projects Helper class code
    public static function getAuthor($id)
    {
      $user=User::find($id);
      return $user->email;
    }

    public static function getCustomer($id)
    {
      $user=Clients::find($id);
      return $user;
    }

    public static function getProject($id)
    {
      $project=Projects::find($id);
      return $project;
    }

    public static function InvNum(){
      $last=Invoice::select(DB::raw('MAX(invoice_number)as max'))->get();
      return (int)$last[0]->max+1;
    }

    public static function paidAmount($project_id){
        $paidAmount=Invoice::Where('project_id',$project_id)->where('status','Paid')->get();
        $total=0;
        foreach($paidAmount as $row){
          $total+=$row->amount;
        }
        return $total;
    }

    public static function getClientEamil($project_id){
      $client=Projects::find($project_id);
      $id=$client->client_id;

      $email=Clients::find($id);
      return $email;
    }

    public static function getUser($id)
    {
        $user=User::find($id);
        return $user;
    }

    public static function addActivityLog($activity)
    {
        $activityLog=new ActivityLogsController();
        $activityLog->user_id =Auth()->id();
        $activityLog->activity =$activity;
        $activityLog->ip_address =request()->ip();
        $activityLog->user_agent =request()->header('user-agent');
        $activityLog->created_at =now();
        $activityLog->save();
    }

    
  }