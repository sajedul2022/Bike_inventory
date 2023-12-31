<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->paginate(5);

        return view('supplier.index', compact('suppliers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
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
            'supplier_name' => 'required',
            'phone' => 'required',
            'nid_image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        // {{-- 'dob', 'mediator_name', 'mediator_phone' --}}

        // $validator = Validator([
        //     'supplier_name' => 'required',
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

        Supplier::create($input);

        return redirect()->route('purchase.create')
            ->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'supplier_name' => 'required',
            'phone' => 'required',
            'nid_image' => 'image|mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        // $validator = Validator([
        //     'supplier_name' => 'required',
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

        $supplier->update($input);

        return redirect()->route('suppliers.index')
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Deleted successfully');
    }

    // due
    public function supplierDue()
    {
        $suppDues =  DB::table('suppliers')
        ->join('purchases', 'suppliers.id', '=', 'purchases.supplier_id')
        ->whereNot('purchases.purchase_balance_due' , '=','NULL')
        ->select('suppliers.id',  'suppliers.supplier_name','suppliers.phone','suppliers.address','suppliers.mediator_phone', 'purchases.product_id','purchases.purchase_invoice_no','purchases.purchase_total_amount','purchases.purchase_amount_paid','purchases.purchase_balance_due',)
        ->latest('purchases.created_at')->paginate(10);
        // ->get();

        return view('supplier.supplier_due', compact('suppDues', ))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
