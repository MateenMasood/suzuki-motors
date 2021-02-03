<?php

namespace App\Http\Controllers\Inventories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryInfo;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInventory;
use JavaScript;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;



class InventoryController extends Controller
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
        return view('inventories.inventory-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.inventory-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventory $request)
    {
        $validated = $request->validated();


        /********* create data array for bulk insert ******** */


        for ($i=0; $i <count($request->colors) ; $i++) {
            $dataArray=array('product_version_id'=>$request->version,
                    'type'=>$request->type,
                    'color'=>$request->colors[$i],
                    'engine_no'=>$request->engineNos[$i],
                    'chassis_no'=>$request->chasisNos[$i],
                    'current_status'=>Config::get('constants.pending'),
                    'status'=>'1',
                    'created_by'=>Auth::id());

                    DB::beginTransaction();
                    try
                    {
                    $id = Inventory::insertGetId($dataArray);

                    $inventoryInfoModel = new InventoryInfo();
                    $inventoryInfoModel->inventory_id = $id;
                    $inventoryInfoModel->key = 'current_status';
                    $inventoryInfoModel->vlaue = Config::get('constants.pending');
                    $inventoryInfoModel->sub_value = time();
                    $inventoryInfoModel->info_type = 'status-change';
                    $inventoryInfoModel->status = '1';
                    $inventoryInfoModel->created_by = Auth::id();
                    $inventoryInfoModel->Save();

                    DB::commit();

                    } catch(Exception $e){

                            DB::rollback();
                            return $e;
                    }

                }

            return \response()->json(['success'=>'Inventory added successfully']);






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        $inventoryInfo=$inventory->inventoryInfo->last();

        JavaScript::put([
            'inventoryJavaScriptData' => $inventory,
            'inventoryInfoJavaScriptData' => $inventoryInfo,

        ]);

        return \View::make('inventories.inventory-show' , compact('inventory' , 'inventoryInfo')) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
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
        $inventoryModel =  Inventory::find($id);

        if($inventoryModel->engine_no == null && $inventoryModel->chassis_no == null){
            $inventoryModel->engine_no = $request->engineNo;
            $inventoryModel->chassis_no = $request->chassisNo;

            if($inventoryModel->save()){
                return response()->json(['status' => 'true' , 'message' => 'Engine and Chassis Number added successfully']);

            }else{

                return response()->json(['status' => 'false' , 'message' => 'Some error occured Please try again']);

            }
        }else{
            return response()->json(['status' => 'false' , 'message' => 'You already add the engine and chassis number of this inventory']);

        }

        // Inventory::update
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

        /********  Branches Datatable ******************/

        public function datatable()
        {
            return response()->json(Inventory::Where('current_status' , '!=' , Config::get('constants.product_sold') )->with('productVersion.product.branch')->get());
        }

        /********  Branches Select2 Inventory Items Type Allocation ******************/

    public function select2InventoryItemsTypeAllocation(Request $request)
    {

        return response()->json(Inventory::where('color',$request->color)
                                ->where('product_version_id',$request->versionId)
                                ->where('type' , 'allocation')
                                ->where(function ($query){
                                    $query->where('current_status' , Config::get('constants.pending'))
                                          ->orWhere('current_status' , Config::get('constants.transition'))
                                          ->orWhere('current_status' , Config::get('constants.stock_in'));
                                })
                                ->get(['id','engine_no','chassis_no']));
    }

    public function getInventoryItemEngineChasis(Request $request)
    {
        $item=Inventory::find($request->inventoryItemId);
        // $itemPrice=ProductsPrices::where('product_version_id',$request->versionId)->where('taxpayer_type',$request->customerTaxStatus)->first(['id','invoice_price','taxpayer_type']);

       return response()->json(['item'=>$item,]);
    }


    // ********************************** change inventoy ststus ***************************

    public function changeInventoryStatus(Request $request)
    {
        $validateData = $request->validate([
            'inventoryId' => 'required|numeric',
            'inventoryStatus' => 'required'
        ]);

        $inventoryData = Inventory::find($validateData['inventoryId']);
        $inventoryInfo=$inventoryData->inventoryInfo->last();

        if ($inventoryData->current_status == Config::get('constants.product_hold')) {

            if (($inventoryInfo->vlaue == Config::get('constants.pending') &&
                $validateData['inventoryStatus'] == Config::get('constants.transition')) ||
                ($inventoryInfo->vlaue == Config::get('constants.transition') &&
                $validateData['inventoryStatus'] == Config::get('constants.stock_in')) ) {

                DB::beginTransaction();

                try
                {


                    $inventoryInfoModel = new InventoryInfo();
                    $inventoryInfoModel->inventory_id = $validateData['inventoryId'];
                    $inventoryInfoModel->key = 'current_status';
                    $inventoryInfoModel->vlaue = $validateData['inventoryStatus'];
                    $inventoryInfoModel->sub_value = time();
                    $inventoryInfoModel->info_type = 'status-change';
                    $inventoryInfoModel->status = '1';
                    $inventoryInfoModel->created_by = Auth::id();

                    $inventoryInfoModel->Save();

                    DB::commit();
                    return \response()->json(['status'=>'true' , 'message'=>'Inventory status change successfully' , 'inventoryStatus']);

                } catch(Exception $e){

                        DB::rollback();
                        return $e;
                }
            }else{
                    return "you can't change the status from ".$inventoryData->current_status." to ".$validateData['inventoryStatus'];
                }

        }else{

            if (($inventoryData->current_status == Config::get('constants.pending') &&
            $validateData['inventoryStatus'] == Config::get('constants.transition')) ||
            ($inventoryData->current_status == Config::get('constants.transition') &&
            $validateData['inventoryStatus'] == Config::get('constants.stock_in')) ) {

            DB::beginTransaction();

            try
                {

                    $inventoryModel = Inventory::find($validateData['inventoryId']);

                    $inventoryModel->current_status = $validateData['inventoryStatus'];

                    $inventoryModel->save();

                    $inventoryInfoModel = new InventoryInfo();
                    $inventoryInfoModel->inventory_id = $inventoryModel->id;
                    $inventoryInfoModel->key = 'current_status';
                    $inventoryInfoModel->vlaue = $validateData['inventoryStatus'];
                    $inventoryInfoModel->sub_value = time();
                    $inventoryInfoModel->info_type = 'status-change';
                    $inventoryInfoModel->status = '1';
                    $inventoryInfoModel->created_by = Auth::id();

                    $inventoryInfoModel->Save();

                    DB::commit();
                    return \response()->json(['status'=>'true' , 'message'=>'Inventory status change successfully' , 'inventoryStatus']);

                } catch(Exception $e){

                    DB::rollback();
                    return $e;
                }
            }else{
                return "you can't change the status from ".$inventoryData->current_status." to ".$validateData['inventoryStatus'];
            }

        }




    }


}
