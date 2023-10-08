<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(5);

        return view('customer.index', compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'customer_name' => 'required',
            'phone' => 'required',
            'nid_image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        // $validator = Validator([
        //     'customer_name' => 'required',
        //     'phone' => 'required',
        //     'nid_image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        // ]);


        $input = $request->all();

        if ($image = $request->file('nid_image')) {
            $destinationPath = "images/";
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['nid_image'] = "$profileImage";
        }

        Customer::create($input);

        return redirect()->route('sales.create')
            ->with('success', ' created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'nid_image'=>'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        // $validator = Validator([
        //     'customer_name' => 'required',
        //     'phone' => 'required',
        //     'nid_image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        // ]);

        $input = $request->all();

        if ($image = $request->file('nid_image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['nid_image'] = "$profileImage";
        } else {
            unset($input['nid_image']);
        }

        $customer->update($input);

        // if ($validator->fails()) {
        //     return back()->withInput()->withErrors($validator);
        // } else {
        //     return redirect()->route('customers.index')
        //         ->with('success', ' created successfully.');
        // }

        return redirect()->route('customers.index')
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Deleted successfully');
    }

     // due
     public function customerDue()
     {
         $CusDues =  DB::table('customers')
         ->join('sales', 'customers.id', '=', 'sales.customer_id')
         ->whereNot('sales.sales_balance_due' , '=','NULL')
         ->select('customers.id',  'customers.customer_name','customers.phone','customers.address','customers.mediator_phone', 'sales.product_id','sales.sales_invoice_no','sales.sales_total_amount','sales.sales_amount_paid','sales.sales_balance_due',)
         ->latest('sales.created_at')->paginate(10);
         // ->get();

         return view('customer.customer_due', compact('CusDues', ))
             ->with('i', (request()->input('page', 1) - 1) * 5);
     }


}
