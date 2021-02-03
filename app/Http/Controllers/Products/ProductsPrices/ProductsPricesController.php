<?php

namespace App\Http\Controllers\Products\ProductsPrices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductPrice;
use Illuminate\Support\Facades\DB;
use App\Models\ProductsPrices;
use App\Models\TaxAmount;
use Illuminate\Support\Facades\Auth;

class ProductsPricesController extends Controller
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
        return view('Products.ProductsPrices.products-prices-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.ProductsPrices.product-price-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPrice $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try
        {

    $productPrice= ProductsPrices::create([
        'product_version_id' => $validated['version'],
        'invoice_price' => $validated['invoicePrice'],
        'description' => $request->description,
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'product price added successfully']);

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
        return response()->json(ProductsPrices::with('productVersion.product.branch')->get());
    }

    /********  Product Prices Select2  ******************/

    public function select2ProductsPrices(Request $request)
    {
        return response()->json(ProductsPrices::where('name','like',"%$request->searchTerm%")->get(['id','name']));
    }

    public function productInvoicePrice(Request $request)
    {
        $itemPrice=ProductsPrices::where('product_version_id',$request->versionId)->first(['id','invoice_price']);
        return response()->json(['itemPrice'=>$itemPrice,]);



    }
}
