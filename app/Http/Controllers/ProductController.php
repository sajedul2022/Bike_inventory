<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\purchase;
use App\Models\Stock;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('products.create', compact('categories'));
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
            'name' => 'required',
            'category_id' => 'required',
            // 'image'=>'mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        // $validator = Validator([
        //     'name' => 'required',
        //     'category_id' => 'required',
        //     'image' => 'mimes:jpeg,png,jpg,giv,svg|max:2048',
        // ]);

        // $input=$request->all();

        $input['auth_id'] = Auth::id();
        $input['product_code'] = rand(100, 100000);
        $input['category_id'] = $request->category_id;
        $input['name'] = $request->name;
        $input['manufacturer'] = $request->manufacturer;
        $input['measurement_unit'] = $request->measurement_unit;
        $input['detail'] = $request->detail;
        // $input['image'] = $image;
        $input['model'] =  $request->model;
        $input['color'] =  $request->color;
        $input['chassis_number'] =  $request->chassis_number;
        $input['engine_number'] = $request->engine_number;
        $input['cubic_capacity'] = $request->cubic_capacity;
        $input['reg_number'] = $request->reg_number;
        $input['reg_date'] = $request->reg_date;
        $input['product_status'] = 1;

        if ($image = $request->file('image')) {
            $destinationPath = "images/";
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Product::create($input);

        return redirect()->route('products.index')->withInput()
            ->with('success', ' created successfully.');

        // if ($validator->fails()) {
        //     return back()->withInput()->withErrors($validator);
        // } else {
        //     return redirect()->route('products.index')
        //         ->with('success', ' created successfully.');
        // }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        // if ($product->user_id != Auth::id()) {
        //     return redirect()->back();
        //   }
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg,giv,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $product->update($input);

        return redirect()->route('products.index')
            ->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', ' deleted successfully');
    }

    // search
    use Searchable;

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search columns from the  table
        $Searchs = Product::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('product_code', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->orWhere('chassis_number', 'LIKE', "%{$search}%")
            ->orWhere('engine_number', 'LIKE', "%{$search}%")
            ->orWhere('reg_number', 'LIKE', "%{$search}%")
            ->simplePaginate(5);
        // ->get();

        return view('search.allsearch', compact('Searchs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    //  search view

    public function show(Product $product)
    {
        $productID = $product['id'];

        $purchases  = DB::table('purchases')->where('product_id', '=', $productID)->select('id', 'product_id', 'supplier_id')->get();
        $SupplierID = isset($purchases[0]->supplier_id) ? $purchases[0]->supplier_id : null;
        $supplier  = DB::table('suppliers')->where('id', '=', $SupplierID)->select('*')->get();

        $sales  = DB::table('sales')->where('product_id', '=', $productID)->select('id', 'product_id', 'customer_id')->get();
        $customerID = isset($sales[0]->customer_id) ? $sales[0]->customer_id : null;
        $customer  = DB::table('customers')->where('id', '=', $customerID)->select('*')->get();


        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('search.searchview', compact('product', 'categories', 'supplier', 'customer'));
    }

    // stock

    public function stock(Product $product)
    {

        $stocks =  DB::table('products')
        ->join('stocks', 'products.id', '=', 'stocks.product_id')
        ->select('products.id',  'products.name','products.product_code','products.manufacturer','products.reg_number', 'stocks.product_stock',)
        ->latest('stocks.created_at')->paginate(10);
        // ->get();

        // return dd($stocks);
        // $stocks = Stock::with('products')->get();
        // $stocks = Stock::latest()->paginate(5);

        return view('products.stock', compact('stocks', ))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


}
