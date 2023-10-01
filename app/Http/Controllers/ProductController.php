<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

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
            'name'=>'required',
            'category_id'=>'required',
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
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
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



}
