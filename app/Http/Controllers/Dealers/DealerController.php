<?php

namespace App\Http\Controllers\Dealers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDealer;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('Dealers.dealers-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Dealers.dealer-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealer $request)
    {
        $validated = $request->validated();

        $dealerModel = new Dealer();

        $dealerModel->bank_branch_id =  $validated['bankBranchId'];
        $dealerModel->commission =  $validated['commission'];
        $dealerModel->name =     $validated['name'];
        $dealerModel->contact =  $validated['phoneNo'];
        $dealerModel->type = 'Bank';
        $dealerModel->status = '1';
        $dealerModel->created_by = Auth::id();

        if(! $dealerModel->save()){
            return false;
        }else{
            return true;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // **************** get all data in datatables ******************

       // ***************** datatable return data ********

       public function datatable()
       {
           // ***************** get and return all products **********
           return Dealer::where('created_by' , Auth::id())->with('bankBranches.bank')->get();

       }

      public function select2BankBranchDealers(Request $request)
      {

        return response()->json(Dealer::where('bank_branch_id',$request->bankBranchId)->get());

      }


}
