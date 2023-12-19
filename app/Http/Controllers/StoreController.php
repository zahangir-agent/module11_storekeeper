<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use App\Models\Salehistories;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\DBAL\TimestampType;

class StoreController extends Controller
{
    function dashboard(){
        
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonth = Carbon::now()->subMonth()->month;
        $lastYear = $currentYear - 1;
        
        $totalsale=DB::table('salehistories')->sum('price');
        $todaysale=DB::table('salehistories')->whereDate('created_at', $today)->sum('price');
        $yesterdaysale=DB::table('salehistories')->whereDate('created_at', $yesterday)->sum('price');
        $thismonthsale=DB::table('salehistories')->whereMonth('created_at', $currentMonth)->sum('price');
        $thisyearsale=DB::table('salehistories')->whereYear('created_at', $currentYear)->sum('price');
        $lastmonthsale=DB::table('salehistories')->whereMonth('created_at', $lastMonth)->sum('price');
        $lastyeasale=DB::table('salehistories')->whereYear('created_at', $lastYear)->sum('price');
        return view('dashboard',compact('totalsale','todaysale', 'yesterdaysale','thismonthsale','thisyearsale','lastmonthsale','lastyeasale'));
    }

    function productlist(){
        $products=DB::table('products')->get();
        return view('productlist',compact('products'));
    }

    function addproduct(){
        return view('addproduct');
    }
    
    public function store(Request $request)
    {

        $request->validate([
            'name'              => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'quantity'          => 'required',
            

        ]);

        {
            $data = [];
            $data['name']           = $request->name;
            $data['description']    = $request->description;
            $data['price']          = $request->price;
            $data['quantity']       = $request->quantity;
            $data['created_at']     = date('ymdHis');
            $data['updated_at']     = date('ymdHis');
          


            $items = Products::insert($data);

            return redirect()->back()->withSuccess('IT WORKS!');

            if($items)
            {
                return redirect()->back()->withSuccess('Product added successfully!');

            }else
            {
                return redirect()->back();
            }

        }
    }

    
    function updateproduct(){
        return view('updateproduct');
    }

    function updateview($id){
        $products = DB::table('products')->find($id);
        return view('updateproduct', compact('products'));
    }

    public function update(Request $request)
    {

        $data = [];
        $data['price']          = $request->price;
        $data['quantity']       = $request->quantity;
        $data['updated_at']     = date('ymdHis');
        $update = Products::where('id', $request->id)->update($data);
        if($update){
            return redirect()->back();
                }else{
                    return redirect()->back();
                }
    }

    function saleview($id){
        $products = DB::table('products')->find($id);
        return view('saleproduct', compact('products'));
    }
    

    public function sale(Request $request)
    {

        $request->validate([
            'price'             => 'required',
            'quantity'          => 'required',
        ]);

        {
            $data = [];
            $data['product_id']     = $request->id;
            $data['price']          = $request->price;
            $data['quantity']       = $request->quantity;
            $data['created_at']     = date('ymdHis');
            $data['updated_at']     = date('ymdHis');
         
            $items = Salehistories::insert($data);

            $dataupate = [];
            $dataupate['quantity']       = $request->quantity;
            $dataupate['updated_at']     = date('ymdHis');
            $update = Products::where('id', $request->id)->update($dataupate);



            return redirect()->back()->withSuccess('IT WORKS!');

            if($items)
            {
                return redirect()->back()->withSuccess('Product added successfully!');

            }else
            {
                return redirect()->back();
            }

        }
    }


    function transactionalhistory(){
        $productsalehistory = DB::table('salehistories')
        ->join('products', 'salehistories.product_id', '=', 'products.id')
        ->select('salehistories.*', 'products.name','products.description')->orderBy('id', 'asc')
        ->paginate(10);         
        return view('transactionalhistory',compact('productsalehistory'));
    }
}
