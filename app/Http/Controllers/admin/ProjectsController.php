<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;

use App\Models\Clients;
use App\Models\Invoice;
use App\Models\Invoice_description;
use Illuminate\Support\Facades\Storage;
use PDF;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects=Projects::
          select('clients.email as client_email','projects.*')
          ->join('clients','clients.client_id','projects.client_id')
          ->orderBy('created_at','DESC')
          ->get();

        $clients=Clients::orderBy('created_at','DESC')->get();

        return view('admin.projects.projects',compact('projects','clients'));
    }

    public function store(Request $request)
    {
        $datavalidate=$request->validate([
            'project_name'=>'required',
            'client'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'status'=>'required',
            'budget'=>'required',
            'currency'=>'required',
        ]);
        if($datavalidate)
        {
            $project=new Projects();
            $project->project_name=$request->project_name;
            $project->client_id=$request->client;
            $project->start_date=$request->start_date;
            $project->end_date=$request->end_date;
            $project->status=$request->status;
            $project->budget=$request->budget;
            $project->currency=$request->currency;
            $project->description=$request->description;
            $project->author=Auth::id();
            $project->save();
            return response()->json(['success'=>'Project added successfully']); 
        }
    }

    public function edit($id)
    {
        $project=Projects::find($id);
        return Response()->json($project);  
    }

    public function update(Request $request)
    {
        $datavalidate=$request->validate([
            'project_name'=>'required',
            'client'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'status'=>'required',
            'budget'=>'required',
            'currency'=>'required',
        ]);
        if($datavalidate)
        {
            $project=Projects::find($request->hidden_id);
            $project->project_name=$request->project_name;
            $project->client_id=$request->client;
            $project->start_date=$request->start_date;
            $project->end_date=$request->end_date;
            $project->status=$request->status;
            $project->budget=$request->budget;
            $project->currency=$request->currency;
            $project->description=$request->description;
            $project->save();
            return response()->json(['success'=>'Clients updated successfully']); 
        }
    }

    public function destroy($id)
    {
        Projects::find($id)->delete();
        return response()->json(['success'=>'Record successfully deleted']);    
    }

    public function show($id){
        $project=Projects::join('clients','clients.client_id','projects.client_id')->where('projects.project_id',$id)->get();
        $project=$project[0];
        
        $invoices=Invoice::select('projects.project_name','invoices.*','users.email')
          ->join('projects','projects.project_id','invoices.project_id')
        ->join('users','users.id','invoices.author')
        ->where('projects.project_id',$id)
        ->orderBy('invoices.created_at','DESC')
        ->get();

        return view('admin.projects.info',compact('project','invoices'));
    }

}
