<?php

namespace App\Http\Controllers\AddOns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreExtendedWarranty;
use App\Models\ExtendedWarranty;
use Illuminate\Support\Facades\Auth;

class ExtendedWarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Add-Ons.Extended-Warranty.extended-warranty-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add-Ons.Extended-Warranty.extended-warranty-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExtendedWarranty $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try
        {

    $productPrice= ExtendedWarranty::create([
        'product_version_id' => $validated['version'],
        'warranty_type' => $validated['warrantyType'],
        'price_type' => $validated['priceType'],
        'price' => $validated['price'],
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'extended warranty added ssuccessfully']);

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

    /********  Product Prices Datatable ******************/

    public function datatable()
    {
        return response()->json(ExtendedWarranty::with('productVersion.product.branch')->get());
    }

    public function extendedWarrantyPlan(Request $request)
    {
        // return $request->all();
        $extendedWarranty=ExtendedWarranty::where('product_version_id',$request->versionId)->
        where('warranty_type',$request->extendedWarrantyPlan)->
        where('price_type',$request->warrantyPricePlan)->first(['id','price']);

        return response()->json(['extendedWarranty'=>$extendedWarranty]);

    }
}
