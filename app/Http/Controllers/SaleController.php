<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\sale;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
    {
         $this->middleware('permission:sales-list|sales-create|sales-edit|sales-delete', ['only' => ['index','show']]);
         $this->middleware('permission:sales-create', ['only' => ['create','store']]);
         $this->middleware('permission:sales-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sales-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $customers = Customer::get();
        $products = Product::get();

        $sales = sale::latest()->paginate(5);
        return view('sales.index', compact('sales', 'customers', 'products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        $products = Product::get();
        $stocks = Stock::get();

        return view('sales.create', compact('customers', 'products', 'stocks'));


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
            'customer_id' => 'required',
            'product_id' => 'required',
            'sales_quantity' => 'required',
            'sale_price' => 'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        $input['customer_id'] = $request->customer_id;
        $input['product_id'] = $request->product_id;
        // $input['sales_invoice_no'] = rand(100, 100000);
        $input['sales_invoice_no'] = date('Ydis');;
        $input['sales_quantity'] = $request->sales_quantity;
        $input['sale_price'] = $request->sale_price;
        $input['sales_amount'] = $input['sale_price'] * $input['sales_quantity'];
        $input['sales_vat'] = $request->sales_vat;
        $input['sales_discount'] = $request->sales_discount;
        $input['sales_balance_due'] = $request->sales_balance_due;
        $input['sales_amount_paid'] = $request->sales_amount_paid;
        $input['sales_total_amount'] = $input['sales_balance_due'] + $input['sales_amount_paid'];
        // $input['sale_price'] =  $request->sale_price;
        $input['sales_payment_type'] =  $request->sales_payment_type;
        $input['sales_date'] =  $request->sales_date;
        $input['sales_payment_status'] = 1;

        // if ($image = $request->file('image')) {
        //     $destinationPath = "images/";
        //     $profileImage = date('YmdHis') . "." . $image->entOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }
        // $input['auth_id'] = Auth::id();
        // $input['image'] = $image;

        // sale::create($input);

        // stock table

        $productID = $request->product_id;
        $oldStockData  = DB::table('stocks')->where('product_id', '=', $productID)->select('id', 'product_id', 'product_stock')->get();

        $oldStocks =  isset($oldStockData[0]->product_stock) ? $oldStockData[0]->product_stock : null;
        $InputStocks = $request->sales_quantity;
        $checkStock = $oldStocks >= $InputStocks;
        // return dd($checkStock);

        if($checkStock == false){
           return redirect()->back()->with('success', 'Not Enough Stock Here.');
        }else{
            sale::create($input);
        }


        $oldID =  isset($oldStockData[0]->id) ? $oldStockData[0]->id : null;
        $oldproductID =  isset($oldStockData[0]->product_id) ? $oldStockData[0]->product_id : null;
        $oldStock =  isset($oldStockData[0]->product_stock) ? $oldStockData[0]->product_stock : null;
        $InputStock = $request->sales_quantity;
        $UpdateStock = $oldStock - $InputStock;
        $CheckID = $oldproductID == $productID;
        // return dd($CheckID);

        if ($CheckID == true) {

            $stock = Stock::find($oldID);
            $stock->update([
                'product_id' => $request->product_id,
                'product_stock' => $UpdateStock,
                'stock_status' => 1,
            ]);
        } elseif ($CheckID == false) {

            $stock = new Stock;
            $stock->create([
                'product_id' => $request->product_id,
                'product_stock' => $request->purchase_quantity,
                'stock_status' => 1,
            ]);
        }

        return redirect()->route('sales.index')
            ->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(sale $sale)
    {
        $saleId = $sale['id'];
        $sales  = DB::table('sales')->where('id', '=', $saleId)->select('*')->get();

        $ProductID = isset($sales[0]->product_id) ? $sales[0]->product_id : null;
        $products  = DB::table('products')->where('id', '=', $ProductID)->select('*')->get();

        $customerID = isset($sales[0]->customer_id) ? $sales[0]->customer_id : null;
        $customers  = DB::table('customers')->where('id', '=', $customerID)->select('*')->get();

        // return dd($SupplierID);

        $pdf = Pdf::loadView('sales.sales_invoice', compact('sales', 'customers', 'products'));
        return $pdf->stream('billing-invoice');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(sale $sale)
    {
        //
    }
}
