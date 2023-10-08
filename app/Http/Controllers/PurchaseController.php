<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {

        $request->validate([
            'supplier_id' => 'required',
            'product_id' => 'required',
            'purchase_quantity' => 'required',
            'purchase_rate' => 'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        $input['supplier_id'] = $request->supplier_id;
        $input['product_id'] = $request->product_id;
        // $input['purchase_invoice_no'] = rand(100, 100000); time('His') date('Ymd').
        $input['purchase_invoice_no'] = date('Ydis');
        $input['purchase_quantity'] = $request->purchase_quantity;
        $input['purchase_rate'] = $request->purchase_rate;
        $input['purchase_amount'] = $input['purchase_rate'] * $input['purchase_quantity'];
        $input['purchase_vat'] = $request->purchase_vat;
        $input['purchase_discount'] = $request->purchase_discount;
        $input['purchase_balance_due'] = $request->purchase_balance_due;
        $input['purchase_amount_paid'] = $request->purchase_amount_paid;
        $input['purchase_total_amount'] = $input['purchase_balance_due'] + $input['purchase_amount_paid'];
        // $input['sale_price'] =  $request->sale_price;
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

        // stock table

        $productID = $request->product_id;
        $oldStockData  = DB::table('stocks')->where('product_id', '=', $productID)->select('id', 'product_id', 'product_stock')->get();
        $oldID =  isset($oldStockData[0]->id) ? $oldStockData[0]->id : null;
        $oldproductID =  isset($oldStockData[0]->product_id) ? $oldStockData[0]->product_id : null;
        $oldStock =  isset($oldStockData[0]->product_stock) ? $oldStockData[0]->product_stock : null;
        $InputStock = $request->purchase_quantity;
        $UpdateStock = $oldStock + $InputStock;
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

        // return redirect()->route('generate-pdf')
        return redirect()->route('purchase.index')
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
        $purchaseID = $purchase['id'];
        $purchases  = DB::table('purchases')->where('id', '=', $purchaseID)->select('*')->get();

        $ProductID = isset($purchases[0]->product_id) ? $purchases[0]->product_id : null;
        $products  = DB::table('products')->where('id', '=', $ProductID)->select('*')->get();

        $SupplierID = isset($purchases[0]->supplier_id) ? $purchases[0]->supplier_id : null;
        $suppliers  = DB::table('suppliers')->where('id', '=', $SupplierID)->select('*')->get();


        // return dd($SupplierID);

        $pdf = FacadePdf::loadView('purchase.purchase_invoice', compact('purchases', 'suppliers', 'products'));
        return $pdf->stream('billing-invoice');

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

    // search field



}
