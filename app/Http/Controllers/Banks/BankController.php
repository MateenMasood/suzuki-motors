<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBankLogo;
use App\Http\Requests\StoreBank;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
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
        return \View::make('Banks.banks-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Banks.bank-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBank $request)
    {
         // ***************** adding banks intodatabse ******************

        // The incoming request is valid...

        // Retrieve the validated input data...
       $validated = $request->validated();
       $bank  = new Bank();

       $bank->name = $validated['bankName'];
       $bank->logo = $validated['logo'];

       $bank->status = '1';
       $bank->created_by = Auth::id();


       if(! $bank->save()){
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

    // ****************** upload bank logos *************

    public function logoUpload(StoreBankLogo $request)
    {

        // The incoming request is valid...

        // Retrieve the validated input data...

        $validated = $request->validated();

        // **************** get the original image name here 8
        $imageName = time().'.'.$request->file->extension();
        $imagePath = $request->file->storeAs('uploads/Bank logos' , $imageName);
        return $imagePath;

    }



    // *********************** selecte2 get all banks ***********

    public function select2Products(Request $request)
    {
        return response()->json(Bank::where('name','like',"%$request->searchTerm%")->get(['id' , 'name']));

    }

    public function datatable()
    {
        return Bank::all();
    }
}
