<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Clients;
use App\Models\Projects;

class ClientsController extends Controller
{
    public function index()
    {
        $clients=Clients::select('users.email as emails','clients.*')->join('users','users.id','clients.author')->get();
        return view('admin.clients.index',compact('clients'));
    }

    public function store(Request $request)
    {
        $datavalidate=$request->validate([
            'full_name'=>'required',
            'phone_number'=>'required',
            'email_address'=>'required|email|unique:clients,email',
            'address'=>'required',
        ]);
       
        if($datavalidate)
        {
            $client=new Clients();
            $client->full_name=$request->full_name;
            $client->phone=$request->phone_number;
            $client->email=$request->email_address;
            $client->address=$request->address;
            $client->author=Auth::id();
            $client->save();
            return response()->json(['success'=>'Clients added successfully']); 
        }
    }


    
    public function edit($id)
    {
        $client=Clients::find($id);
        return Response()->json($client);  
    }


    public function update(Request $request)
    {
        $datavalidate=$request->validate([
            'full_name'=>'required',
            'phone_number'=>'required',
            'email_address'=>'required|email',
            'address'=>'required',
        ]);
 
        if($datavalidate)
        {
            $client=Clients::find($request->hidden_id);
            $client->full_name=$request->full_name;
            $client->phone=$request->phone_number;
            $client->email=$request->email_address;
            $client->address=$request->address;
            $client->save();
            return response()->json(['success'=>'Clients updated successfully']); 
        }
        
    }

    public function destroy($id)
    {
        Clients::find($id)->delete();
        return response()->json(['success'=>'Record successfully deleted']);    
    }

}
