<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = DB::table('customers')->count();
        $products = DB::table('products')->count();
        $sales = DB::table('sales')->sum('sales_quantity');
        $salesTotal = DB::table('sales')->sum('sales_total_amount');
        $stocks =  DB::table('products')
        ->join('stocks', 'products.id', '=', 'stocks.product_id')
        ->select('products.id',  'products.name','products.product_code','products.manufacturer','products.reg_number', 'stocks.product_stock',)
        ->latest('stocks.created_at')->paginate(20);
        // ->get();

        // return dd($salesTotal);

        return view('home', compact('stocks','customers', 'products', 'sales', 'salesTotal' ))->with('i', (request()->input('page', 1) - 1) * 5);


    }

    // profile Manage

    public function profileUpdateShow()
    {
        return view('profile.profile-manage');
    }

    public function profileUpdate(Request $request)
    {
        //validation rules

        $request->validate([
            'name' => 'required|min:4|string|max:255',
            // 'email'=>'required|email|string|max:255'
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        // $user->email = $request['email'];
        $user->save();
        return back()->with('message', 'Profile Updated');
    }

    // password change

    public function passwordChangeindex()
    {
        return view('profile.password-change');
    }

    public function passwordChangeStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        // dd('Password change successfully.');
        return back()->with('message', 'Password change successfully.');
    }

    // home Aggregates  users = DB::table('users')->count();

    // public function homeAggregates (){
    //     users = DB::table('users')->count();
    //     return view('home',);
    // }

}
