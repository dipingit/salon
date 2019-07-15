<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use App\Employee;
use App\Service;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::count();
        $employees = Employee::count();
        $services = Service::count();
        $bills = Bill::groupBy('token')->get()->count();
        return view('home',compact('customers','employees','services','bills'));
    }

    public function returnSMSPage()
    {
        $customers = Customer::all();
        return view('pages.sms',compact('customers'));
    }

    public function sendSMSIndividually(Request $request)
    {
        $to = "";
        for ($i=0; $i < count($request->customer_id); $i++) { 
            $customer = Customer::find($request->customer_id[$i]);
            $to .= $customer->mobile . ',';
        }
        $token = "ec8661ccc3a9ef8faa37a318c5afb44c";
        $message = $request->message;

        $url = "http://api.greenweb.com.bd/api.php";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $smsresult = curl_exec($ch);

        $customers = Customer::all();
        return view('pages.sms',compact('customers'))->with('message', 'Message Successfully Sent');
    }

    public function sendSMSAll(Request $request)
    {
        $to = "";
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $to .= $customer->mobile . ',';
        }

        $token = "ec8661ccc3a9ef8faa37a318c5afb44c";
        $message = $request->message;

        $url = "http://api.greenweb.com.bd/api.php";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $smsresult = curl_exec($ch);

        return view('pages.sms',compact('customers'))->with('message', 'Message Successfully Sent');
    }
}
