<?php

namespace App\Http\Controllers\AddOns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInsuranceProgram;
use App\Models\InsuranceProgram;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InsuranceProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Add-Ons.Insurance-Program.insurance-programs-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add-Ons.Insurance-Program.insurance-program-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInsuranceProgram $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try
        {

    $productPrice= InsuranceProgram::create([
        'product_version_id' => $validated['version'],
        'insurance_type' => $validated['insuranceType'],
        'price' => $validated['price'],
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'insurance program added ssuccessfully']);

        } catch(Exception $e){

                DB::rollback();
                return $e;
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

    public function datatable()
    {
        return response()->json(InsuranceProgram::with('productVersion.product.branch')->get());
    }

    public function insurancePlan(Request $request)
    {
        $insuranceProgram=InsuranceProgram::where('product_version_id',$request->versionId)->
        where('insurance_type',$request->insurancePlan)->first(['id','price']);

        return response()->json(['insuranceProgram'=>$insuranceProgram]);
    }
}
