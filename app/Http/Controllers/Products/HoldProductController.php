<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHoldProduct;
use Illuminate\Support\Facades\DB;
use App\Models\ProductHold;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\InventoryInfo;

class HoldProductController extends Controller
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
        return \View::make('Products.products-hold-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Products.product-hold-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHoldProduct $request)
    {

        $validatedData = $request->validated();
        // return $request->all();

        // ********** start transction ************
        DB::beginTransaction();

        try {

            // *********** store customer info ************

            $customerModel = new Customer();
            $customerModel->name       = $validatedData['customerName'];
            $customerModel->contact    = $validatedData['customerPhoneNo'];
            $customerModel->status     = '1';
            $customerModel->created_by = Auth::id();;

            $customerModel->save();
            $customerId = $customerModel->id;


            // ****************** store product hold info *********

            $productHoldModel = new ProductHold();

            $productHoldModel->inventory_id = $validatedData['inventoryItem'];
            $productHoldModel->customer_id = $customerId;
            $productHoldModel->token_amount	 = $validatedData['tokenAmount'];
            $productHoldModel->description = $validatedData['description'];
            $productHoldModel->status = '1';
            $productHoldModel->created_by = Auth::id();

            $productHoldModel->save();



            // ****************** change the inventory itme status ************

            $inventory = Inventory::find($validatedData['inventoryItem']);

            $inventory->current_status = Config::get('constants.product_hold');

            $inventory->save();

            DB::commit();


            return 'true';

        } catch (\Throwable $th) {

            DB::rollBack();
            throw $th;

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


        $productHold = ProductHold::find($id);
        // return $productHold->inventory->productVersion;
        return \View::make('Products.product-hold-show' , compact('productHold'));
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


    // *************************** datatble product hold all data ************************

    public function datatable()
    {
        // return 'df';
        return ProductHold::where('created_by' , Auth::id())->with('customer' , 'inventory.productVersion.product')->get();
    }


    // ********************* change  inventory status here ***************

    public function inventoryStatus(Request $resquest)
    {
        $validatedData = $resquest->validate([
            'inventoryId' => 'required|numeric',
        ]);

        $productHoldModel =  Inventory::find($validatedData['inventoryId']);

        if ($productHoldModel->current_status == Config::get('constants.product_hold')) {
            $inventoryIfoModelSingleRecord = InventoryInfo::where('inventory_id' , $validatedData['inventoryId'])->latest('created_at')->first();

            $productHoldModel->current_status = $inventoryIfoModelSingleRecord->vlaue;

            if ($productHoldModel->save()) {

            return response()->json(['status' => Config::get('constants.product_unhold') , 'message' => 'your product unhold successfully']);

            }else{

            return response()->json(['status' => 'error' , 'message' => 'some error occured ! error codde : HDJ452HJ']);


            }

        }else{

            $productHoldModel->current_status = Config::get('constants.product_hold');

            if ($productHoldModel->save()) {

                return response()->json(['status' => Config::get('constants.product_hold') , 'message' => 'your product hold successfully']);

            }else{
                return response()->json(['status' => 'error' , 'message' => 'some error occured! error code: FGF452 ']);
            }

        }

    }

    public function putUpForSale(Request $request)
    {
        session(['productHoldId' => $request->productHoldId ]);
        return 'true';
    }
}
