<?php

namespace App\Http\Controllers\AddOns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegistrationFee;
use App\Http\Requests\StoreRegistrationFee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegistrationFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Add-Ons.registration-fee.registration-fee-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add-Ons.registration-fee.registration-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistrationFee $request)
    {
        // return $request->all();
        $validated = $request->validated();

        DB::beginTransaction();
        try
        {

    $taxAmount= RegistrationFee::create([
        'product_version_id' => $validated['version'],
        'fee_amount' => $validated['feeAmount'],
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'fee amount added ssuccessfully']);

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
        return response()->json(RegistrationFee::with('productVersion.product.branch')->get());
    }

    public function registrationFee(Request $request)
    {
        $registrationFee=RegistrationFee::where('product_version_id',$request->versionId)->first(['id','fee_amount']);

        return response()->json(['registrationFee'=>$registrationFee]);
    }
}
