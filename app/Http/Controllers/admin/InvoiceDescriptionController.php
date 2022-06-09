<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Invoice_description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceDescriptionController extends Controller
{
    public function store(Request $request)
    {
        $datavalid=$request->validate([
            'description'=>'required',
            'invoice_id'=>'required',
            'quantity'=>'required',
            'amount'=>'required',
        ]);
        if($datavalid){
            $info=new Invoice_description();
            $info->description=$request->description;
            $info->invoice_id=$request->invoice_id;
            $info->qty=$request->quantity;
            $info->amount=$request->amount;
            $info->author=Auth::id();
            $info->save();
            return response()->json(['success'=>'Charges added to invoice successfully']);
       }
    }

    public function show($id)
    {
        $descripton=Invoice_description::select('users.email','invoice_descriptions.*')
        ->join('users','users.id','invoice_descriptions.author')
        ->where('invoice_id',$id)
        ->get();
        // $total=Invoice_description::where('invoice_id',$id)->sum(amount);
        return response()->json($descripton);
    }

    public function edit($id)
    {
        $descripton= Invoice_description::find($id);
        return response()->json($descripton);

    }

    public function update(Request $request)
    {
        $datavalid=$request->validate([
            'description'=>'required',
            'quantity'=>'required',
            'amount'=>'required',
        ]);
        if($datavalid){
            $info=Invoice_description::find($request->invoice__info_id);
            $info->description=$request->description;
            $info->qty=$request->quantity;
            $info->amount=$request->amount;
            $info->save();
            return response()->json(['success'=>'Charges updated successfully']);
        }
    }
}
