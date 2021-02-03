<?php

namespace App\Http\Controllers\Banks\BankBranches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBankBranch;
use App\Models\BankBranch;
use Illuminate\Support\Facades\Auth;


class BankBranchController extends Controller
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
        return \View::make('Banks.BankBranches.bank-branches-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Banks.BankBranches.bank-branch-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankBranch $request)
    {
         // ***************** adding banks intodatabse ******************

        // The incoming request is valid...

        // Retrieve the validated input data...
       $validated = $request->validated();
       $bankBranch  = new BankBranch();

       $bankBranch->bank_id = $validated['bankId'];
       $bankBranch->code = $validated['branchCode'];
       $bankBranch->name = $validated['branchName'];
       $bankBranch->contact = $validated['branchPhoneNo'];
       $bankBranch->address = $validated['branchAddress'];

       $bankBranch->status = '1';
       $bankBranch->created_by = Auth::id();


       if(! $bankBranch->save()){
           return 'false';
       }else{
           return 'true';
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

      // *************** bank branches view datatable ***************

    public function datatable()
    {

      return BankBranch::with('bank')->get();

    }

    // ******************* get all the branches agniest the selected bank  select**************

    public function select2BankBranches(Request $request)
    {
        return response()->json(BankBranch::where('bank_id',$request->bankId)->get(['id','name']));

    }
}
