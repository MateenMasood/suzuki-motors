<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductHold;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Config;

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
        $adminName = Auth::user()->first_name ." ". Auth::user()->last_name;

        if (Auth::user()->hasRole('Sales Executive')) {
            $productOnHold    = ProductHold::where('created_by' , Auth::id())->count();
            $pendingEnquiries = Enquiry::where(['created_by' => Auth::id() , 'enquiry_status' => Config::get('constants.pending')])->count();
            $totalSales       = '4';
            $totalEnquiries   =  Enquiry::where('created_by'  , Auth::id())->count();
            // $roleName = Auth::user()
            return view('Dashboards.sales-executive-analytical-dashboard' , compact("adminName" , "productOnHold" , "pendingEnquiries" , "totalSales" , "totalEnquiries"));

        }else if(Auth::user()->hasRole('Branch Manager')){

            $productOnHold    = ProductHold::where('created_by' , Auth::id())->count();
            $pendingEnquiries = Enquiry::where(['created_by' => Auth::id() , 'enquiry_status' => Config::get('constants.pending')])->count();
            $totalSales       = '4';
            $totalEnquiries   =  Enquiry::where('created_by'  , Auth::id())->count();
            $roleName = Auth::user()->roles->pluck('name');

            return view('Dashboards.branch-manager-analytical-dashboard' , compact("adminName" , "productOnHold" , "pendingEnquiries" , "totalSales" , "totalEnquiries" , "roleName"));

        }else{

            $productOnHold    = ProductHold::where('created_by' , Auth::id())->count();
            $pendingEnquiries = Enquiry::where(['created_by' => Auth::id() , 'enquiry_status' => Config::get('constants.pending')])->count();
            $totalSales       = '4';
            $totalEnquiries   =  Enquiry::where('created_by'  , Auth::id())->count();
            return view('Dashboards.sales-executive-analytical-dashboard' , compact("adminName" , "productOnHold" , "pendingEnquiries" , "totalSales" , "totalEnquiries"));
        }

    }
}
