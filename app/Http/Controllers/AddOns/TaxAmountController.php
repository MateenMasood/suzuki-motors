<?php

namespace App\Http\Controllers\AddOns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaxAmount;
use App\Models\TaxAmount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaxAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Add-Ons.tax-amount.tax-amounts-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add-Ons.tax-amount.tax-amount-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxAmount $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try
        {

    $taxAmount= TaxAmount::create([
        'product_version_id' => $validated['version'],
        'taxpayer_type' => $validated['taxpayerType'],
        'tax_amount' => $validated['taxAmount'],
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'tax amount added ssuccessfully']);

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
        return response()->json(TaxAmount::with('productVersion.product.branch')->get());
    }

    public function taxAmount(Request $request)
    {
        $taxAmount=TaxAmount::where('product_version_id',$request->versionId)->where('taxpayer_type',$request->customerTaxStatus)->first(['id','tax_amount']);
        return response()->json(['taxAmount'=>$taxAmount,]);
    }
}
