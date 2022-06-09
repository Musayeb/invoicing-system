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
use App\Models\Invoice_description;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response as FacadeResponse;


use PDF;
class InvoiceController extends Controller
{
    public function show($id)
    {
        $invoice=Invoice::where('project_id',$id)->orderBy('created_at','DESC')->get();
        return response()->json($invoice); 
    }

    public function store(Request $request)
    {
        $datavalidate=$request->validate([
            'invoice_number'=>'required',
            'project_name'=>'required',
            'Invoice_amount'=>'required',
            'status'=>'required',
            'deadline'=>'required',
        ]);

        if($datavalidate)
        {
            $invoice=new Invoice();
            $invoice->invoice_number=$request->invoice_number;
            $invoice->project_id=$request->project_name;
            $invoice->amount=$request->Invoice_amount;
            $invoice->status=$request->status;
            $invoice->deadline=$request->deadline;
            $invoice->save();
            return response()->json(['success'=>'Invoice added successfully']); 
        }
    }


    
    public function edit($id)
    {
        $invoice=Invoice::find($id);
        return Response()->json($invoice);  
    }





    public function update(Request $request)
    {
        if($request->status=="Unsent")
        {
            $datavalidate=$request->validate([
                'invoice_number'=>'required',
                'project_name'=>'required',
                'Invoice_amount'=>'required',
                'status'=>'required',
                'deadline'=>'required',
            ]);
        }
        else{
            $datavalidate=$request->validate([
                'invoice_number'=>'required',
                'project_name'=>'required',
                'Invoice_amount'=>'required',
                'status'=>'required',
                'sent_date'=>'required',
                'deadline'=>'required',
            ]);
        }

        if($datavalidate)
        {
            $invoice=Invoice::find($request->invoice_hidden_id);
            $invoice->project_id=$request->project_name;
            $invoice->amount=$request->Invoice_amount;
            $invoice->status=$request->status;
            $invoice->sent_date=$request->sent_date;
            $invoice->deadline=$request->deadline;
            $invoice->save();
            return response()->json(['success'=>'Invoice updated successfully']); 
           
        }
                
    }




    public function destroy($id)
    {
        Invoice_description::where('invoice_id',$id)->delete();
        Invoice::find($id)->delete();
        return response()->json(['success'=>'Invoice successfully deleted']);    
    }

    
    public function sendInvoice($id)
    {

        $project_name="";
        $invoice=Invoice::find($id);
        $project=Projects::where('project_id',$invoice->project_id)->get();
        $project=$project[0];
        $email=Clients::find($project->client_id);
        $client_email=$email->email;
        $client_name=$email->full_name;
        $invoice_number=Crypt::encrypt($invoice->invoice_number);
        $project_name='Project Invoice -  '.$project->project_name.'';


    // invoice created pdf
        $customPaper = array(0,0,567.00,800.80);
        $inv=Invoice::where('invoice_number',$invoice->invoice_number)->get();
        $client=Projects::join('clients','clients.client_id','projects.client_id')->where('project_id',$inv[0]->project_id)->get();
        $invoicess=Invoice_description::where('invoice_id',$inv[0]->invoice_id)->get();
        $pdf_doc =  PDF::loadView('attached_invoice', ['invoice' =>$invoicess ,'client'=>$client,'invoice_number'=>$invoice->invoice_number,'invoice_number_hash'=>$invoice_number])
        ->setPaper($customPaper, 'Landscape');
        $content = $pdf_doc->download()->getOriginalContent();
        $path=Storage::put('public/pdf/Invoice-'.$invoice_number.'.pdf',$content) ;
        $url1=Storage::url('app/public/pdf/Invoice-'.$invoice_number.'.pdf');
    // invoice created pdf
        $url=url($url1);

        $data = array('client_name'=>$client_name,'id'=>$id,'invoice_number'=>$invoice_number,'amount'=>$invoice->amount,'project_name'=>$project->project_name,'currency'=>$project->currency,'deadline'=>$project->deadline);

        mail::send('mail', $data, function($message) use($client_email,$client_name,$project_name,$url){
            $message->from('info@sarey.co','Sarey Solution');
            $message->to($client_email, $client_name);
            $message->subject($project_name);
            $message->attach($url);

           
        });
        $invoice->file_path=$url1;
        $invoice->status='Sent';
        $invoice->save();


        return response()->json(['success'=>'Invoice successfully Sent']);
    }

    public function add($id,$number)
    {
     
       $inv= new Invoice();
       $inv->invoice_number=$number;
       $inv->project_id=$id;
       $inv->author=Auth::id();
       $inv->status="Pending";
       $inv->save();

       session()->flash('notif','Invoice created successfully');
       return back();
        

    }
  
    
}
