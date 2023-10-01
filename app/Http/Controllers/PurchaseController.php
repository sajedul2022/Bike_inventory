<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class PurchaseController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Purchase-list|Purchase-create|Purchase-edit|Purchase-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Purchase-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Purchase-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Purchase-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::get();
        $products = Product::get();

        $purchases = purchase::latest()->paginate(5);
        return view('purchase.index', compact('purchases', 'suppliers', 'products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

        // return view('purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchase.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // id,supplier_id,product_id,purchase_invoice_no,purchase_quantity, purchase_rate, purchase_amount, purchase_amount_paid, purchase_balance_due, purchase_vat, purchase_discount,purchase_total_amount, sale_price, purchase_payment_type, purchase_payment_status,purchase_return_quantity, purchase_return_rate, purchase_return_amount, purchase_return_discount,purchase_return_vat,purchase_date

    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required',
            'product_id' => 'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        $input['supplier_id'] = $request->supplier_id;
        $input['product_id'] = $request->product_id;
        $input['purchase_invoice_no'] = rand(100, 100000);
        $input['purchase_quantity'] = $request->purchase_quantity;
        $input['purchase_rate'] = $request->purchase_rate;
        $input['purchase_amount'] = $input['purchase_rate'] * $input['purchase_quantity'];

        // $input['purchase_amount_paid'] = $request->purchase_amount_paid;
        // $input['purchase_balance_due'] = $request->purchase_balance_due;
        // $input['purchase_vat'] = $request->purchase_vat;
        // $input['purchase_discount'] = $request->purchase_discount;

        // $input['purchase_total_amount'] = $input['purchase_amount'] + $input['purchase_balance_due'] - $input['purchase_amount_paid'] - $input['purchase_balance_due'] -  $input['purchase_discount'];

        $input['sale_price'] =  $request->sale_price;
        $input['purchase_payment_type'] =  $request->purchase_payment_type;
        $input['purchase_date'] =  $request->purchase_date;

        $input['purchase_payment_status'] = 1;

        // if ($image = $request->file('image')) {
        //     $destinationPath = "images/";
        //     $profileImage = date('YmdHis') . "." . $image->entOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }

        // $input['auth_id'] = Auth::id();
        // $input['image'] = $image;


        purchase::create($input);

        return redirect()->route('generate-pdf')
            ->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchase $purchase)
    {
        //
    }

    public function index2()
   {
      return view('purchase.index2');
   }



    public function search(Request $request)
   {
      $employees = Product::all();
      if($request->keyword != ''){
      $employees = Product::where('name','LIKE','%'.$request->keyword.'%')->get();
      }
      return response()->json([
         'employees' => $employees
      ]);
    }
}
