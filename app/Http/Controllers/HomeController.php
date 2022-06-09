<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Invoice;
use App\Models\Projects;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $total_project=Projects::all()->count('project_id');
        $total_client=Clients::all()->count('client_id');
        $total_invoice=Invoice::all()->count('invoice_id');


        return view('dashboard',compact('total_project','total_client','total_invoice'));
    }
}
