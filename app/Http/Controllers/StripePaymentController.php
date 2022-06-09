<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Invoice;
use App\Models\Projects;
use App\Models\Clients;
use App\Models\Incomes;
use App\Models\Invoice_description;
use Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Session\Session as SessionSession;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $decrypted = decrypt($id);
            $info=Invoice::Where('invoice_number',$decrypted)->get();
            if($info[0]->status=="Paid"){
                abort(403);
            }else{
                $invoices=Invoice_description::where('invoice_id',$info[0]->invoice_id) ->get();
                $currency=Projects::find($info[0]->project_id)->currency;

                return view('checkout',compact('info','invoices','currency'));
            }

        } catch (DecryptException $e) {
            abort('404');
        }


    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $info=Invoice::where('invoice_number',$request->invoice_id)->get();
        $info=$info[0];
        if($info->status=="Sent"){
        
       $stripe= Stripe\Charge::create ([
                "amount" => $request->amount * 100,
                "currency" => $request->currency,
                "source" => $request->stripeToken,
                "description" => "Project Invoice Payment invoice #".$request->invoice_id, 
        ]);

        if($stripe){
                $info->status="Paid";
                $info->save();
    
                $income=new Incomes();
                $income->invoice_id=$request->invoice_id;
                $income->amount=$request->amount;
                $income->payment_method="Credit Card";
                $income->save();
                return redirect('payment-success');
        
        }else{
            Session::flash('warning', 'Faild, please check your details');
            return redirect()->back();
        }
        }else{
            Session::flash('warning', 'Invoice is already paid.');
            return redirect()->back();

        }
       
    }
}
