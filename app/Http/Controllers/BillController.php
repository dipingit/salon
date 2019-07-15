<?php

namespace App\Http\Controllers;

use App\Bill;
use App\SaleTransaction;
use App\Customer;
use App\Employee;
use App\Service;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bill.index');
    }

    //server side datatable
    public function allBills(Request $request)
    {      
        $columns = array( 
                            0 =>'id', 
                            1 =>'date',
                            2=> 'customer_id',
                            3=> 'employee_id',
                            4=> 'amount',
                            5=> 'discount',
                            6=> 'vat',
                            7=> 'net_total',
                            8=> 'actions',
                        );
  
        $totalData = Bill::groupBy('token')->get()->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $bills = Bill::with('employee', 'customer','service')
            ->latest()
            ->groupBy('token')
            ->selectRaw('id, employee_id, date, customer_id, discount, sum(amount)as amount, token, vat')
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $bills = Bill::with('service', 'customer', 'employee')
            ->latest()
            ->groupBy('token')
            ->selectRaw('id, employee_id, date, customer_id, discount, sum(amount)as amount, token, vat')
            ->where('date','LIKE',"%{$search}%")
            ->orWhereHas('customer', function($query) use($search) {
                $query->where('name','LIKE',"%{$search}%");
            })
            ->orWhereHas('employee', function($query) use($search) {
                $query->where('name','LIKE',"%{$search}%");
            })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir)
            ->get();

            $totalFiltered = Bill::with('product', 'customer')
            ->groupBy('token')
            ->selectRaw('id, employee_id, date, customer_id, discount, sum(amount)as amount, token, vat')
            ->where('date','LIKE',"%{$search}%")
            ->orWhereHas('customer', function($query) use($search) {
                $query->where('name','LIKE',"%{$search}%");
            })
            ->orWhereHas('employee', function($query) use($search) {
                $query->where('name','LIKE',"%{$search}%");
            })
            ->get()
            ->count();
        }

        $data = array();
        if(!empty($bills))
        {
            foreach ($bills as $key => $value)
            {
                $nestedData['id'] = $key + 1;
                $nestedData['date'] = $value->date->format("d-m-Y");
                $nestedData['customer_id'] = $value->customer->name;
                $nestedData['employee_id'] = $value->employee->name;
                $nestedData['amount'] = $value->amount;
                $nestedData['discount'] = $value->discount;
                $nestedData['vat'] = $value->vat;
                $nestedData['net_total'] = ($value->amount + $value->vat) - $value->discount;
                $nestedData['actions'] = '<div class="btn-group">
                                    <a href="'.route('bill.show',$value->token) .'" class="btn btn-primary btn-sm" title="Show">
                                        Show
                                    </a>
                                    <a href="'.url('bill/print',$value->token) .'" class="btn btn-success btn-sm" title="Print" target="_blank">
                                        Print
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-remote=" '.url('bill/full-destroy',$value->token) .'" title="Delete">Delete</button>
                                </div>';
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bill = null;
        $services = Service::all('id','name');
        $customers = Customer::all('id','name');
        $employees = Employee::all('id','name');
        return view('pages.bill.create', compact('bill','services','customers','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'      => 'required',
            'customer_selection'  => ['required', Rule::notIn(['','0'])],
            'employee_id'  => ['required', Rule::notIn(['','0'])],
        ]);

        $token = time().str_random(10);
        DB::transaction(function () use ($request, $token) {
            if ($request->customer_selection == 2) {
                $customer = DB::table('customers')->insertGetId(
                    [
                        'name' => $request->name,
                        'mobile' => $request->mobile,
                        'address' => $request->address,
                        'age' => $request->age
                    ]
                );
            }
            else {
                $customer = $request->customer_id;
            }
            for ($i=0; $i < count($request->service_id) ; $i++) { 

                $bill =  new Bill;

                $bill->date = $request->date;
                $bill->customer_id = $customer;
                $bill->details = $request->details;
                $bill->service_id = $request->service_id[$i];
                $bill->amount = $request->amount[$i];
                $bill->discount = $request->discount;
                $bill->vat = $request->tax_amount;
                $bill->invoice = $request->invoice;
                $bill->employee_id = $request->employee_id;
                $bill->token = $token;

                $bill->save();
            }

        });

        return redirect()->action(
            'BillController@print', ['id' => $token]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bills = Bill::where('token', $id)->get();
        $total = 0;
        $discount = $bills[0]->discount;
        $vat = $bills[0]->vat;
        $net_total = 0;
        foreach ($bills as $bill) {
            $total += $bill->amount;
        }
        $net_total = ($total + $vat) - $discount;
        return view('pages.bill.show',compact('bills','total','vat','discount','net_total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        $products = Product::all('id','name');
        $customers = Customer::all('id','name');
        return view('pages.bill.edit',compact('bill','products','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'date'      => 'required',
            'rate'      => 'required',
            'quantity'      => 'required',
            'product_id'  => ['required', Rule::notIn(['','0'])],
        ]);
        DB::transaction(function () use ($request, $bill) {
            $transaction = SaleTransaction::where([
                    ['token', $bill->token],
                    ['purpose', '=', '1']
                ])->first();
            $transaction->amount = $transaction->amount - ($bill->amount + $bill->vat);
            $transaction->amount = $transaction->amount + (($request->rate * $request->quantity) + $request->vat);
            $transaction->save();

            $bill->update([
                'date'      => $request->date,
                'details'   => $request->details,
                'rate'     => $request->rate,
                'quantity'     => $request->quantity,
                'vat'     => $request->vat,
                'amount'     => $request->rate * $request->quantity,
                'product_id'    => $request->product_id,
            ]);
        });
        return redirect()
                    ->route('bill.index')
                    ->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        DB::transaction(function () use ($bill) {
            $bill->delete();
        });
        return redirect()
                    ->route('bill.index')
                    ->with('success', 'Deleted Successfully');
    }

    public function destroyBill($id)
    {
        DB::transaction(function () use ($id) {
            $bills = Bill::where('token', $id)->get();
            foreach ($bills as $bill) {
               $bill->delete();
            }
            
        });
        return redirect()
                    ->route('bill.index')
                    ->with('success', 'Deleted Successfully');
    }

    public function print($id)
    {
        $bills = Bill::where('token', $id)->get();
        $total = 0;
        $discount = $bills[0]->discount;
        $vat = $bills[0]->vat;
        $net_total = 0;
        foreach ($bills as $bill) {
            $total += $bill->amount;
        }
        $net_total = ($total + $vat) - $discount;
        $dt = Carbon::now();
        $date = $dt->toDayDateTimeString();
        return view('pages.bill.print',compact('bills','total','vat','discount','net_total','date'));
    }
}
