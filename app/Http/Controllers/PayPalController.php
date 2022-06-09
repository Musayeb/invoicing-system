<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Projects;
use App\Models\Clients;
use App\Models\Incomes;
use Illuminate\Contracts\Session\Session as SessionSession;
use Mail;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Session;
   
class PayPalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function payment($id,$total)
    {

        $invoice=Invoice::find($id);

        $project=Projects::find($invoice->project_id);


        // dd($total);


            $data = [];
            $data['items'] = [
                [
                    'name' => 'Sarey.co',
                    'price' => $total,
                    'desc'  => 'Sarey Solution',
                    'qty' => 1
                ]
            ];
           
            $data['invoice_id'] = $invoice->invoice_number;
            $data['invoice_description'] = "Order #$invoice->invoice_number Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $total;
            $data['currency'] = $project->currency;

            Session::put('invoice_number', $invoice->invoice_number);
            Session::put('amount', $total);
            Session::put('invoice_id', $invoice->invoice_id);


       
            $paypalModule = new ExpressCheckout;
  
            $res = $paypalModule->setExpressCheckout($data);
            $res = $paypalModule->setExpressCheckout($data, true);
      
      
            return redirect($res['paypal_link']);

        // }else{
        //     Session::flash('warning', 'please check Your details.');
        //     return redirect()->back();
        // }


      
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session::flash('warning', 'Your payment is canceled.');
        return redirect()->back();
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
             
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
 
           $incomes= new Incomes();
           $incomes->invoice_id=Session::get('invoice_number');
           $incomes->amount=Session::get('amount');
           $incomes->payment_method='Paypal Checkout';
           $incomes->save();

          $invoice=Invoice::find(Session::get('invoice_id'));
          $invoice->status="Paid";
          $invoice->save();

            return redirect('payment-success');
        }
  
        Session::flash('warning', 'Something is wrong.');
        return redirect()->back();
    }
}