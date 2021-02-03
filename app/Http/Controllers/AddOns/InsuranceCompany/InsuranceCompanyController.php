<?php

namespace App\Http\Controllers\AddOns\InsuranceCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use App\Http\Requests\StoreInsuranceCompany;
use Illuminate\Support\Facades\Auth;

class InsuranceCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Add-Ons.InsuranceCompanies.insurance-companies-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add-Ons.InsuranceCompanies.insurance-company-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsuranceCompany $request)
    {
        $validated = $request->validated();

        $dealerModel = new InsuranceCompany();

        $dealerModel->name =  $validated['name'];
        $dealerModel->email =  $validated['email'];
        $dealerModel->contact =     $validated['phoneNo'];
        $dealerModel->address =  $validated['address'];
        $dealerModel->status = '1';
        $dealerModel->created_by = Auth::id();

        if(! $dealerModel->save()){
            return \response()->json(['status'=>'false' , 'message'=>'error occured ! please try again ERROR CODE : SDSDF45' ]);

        }else{
            return \response()->json(['status'=>'true' , 'message'=>'Insurnace company added successfully' ]);

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


    // ******************************* get all companies data **************

    public function datatable()
    {
        return response()->json(InsuranceCompany::all());

    }
}
