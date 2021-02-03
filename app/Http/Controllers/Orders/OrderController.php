<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Enquiry;
use App\Models\Order;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use JavaScript;
use App\Models\OrderItem;
use App\Models\OrderInfo;
use App\Models\OrderCharge;
use App\Models\OrderRelation;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\Inventory;
use App\Models\InventoryInfo;
use App\Models\ProductVersion;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\OrderDoc;
use Exception;
use App\Models\ProductHold;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
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
        $orders=Order::where('created_by',Auth::id())->get();
        return view('orders.orders-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if ( Str::contains(url()->previous(), 'enquiries')) {
            $enquiryProductCustomer=Enquiry::with('customer','ProductVersion.product')->find(Session('maturedEnquiryId'));
            JavaScript::put([
                'enquiryProductCustomer' => $enquiryProductCustomer,

            ]);
        }

        if ( Str::contains(url()->previous(), 'product-hold')) {
            $productHoldProductInventoryCustomer=ProductHold::with('customer','inventory.ProductVersion.product')->find(Session('productHoldId'));
            JavaScript::put([
                'productHoldProductInventoryCustomer' => $productHoldProductInventoryCustomer,

            ]);
        }
        // return $enquiryProductCustomer;
        return view('orders.order-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {

            /************ Create Order *******************/
            $order= Order::create([
                'invoice_no' => IdGenerator::generate(['table' => 'orders', 'length' => 13, 'field' => 'invoice_no', 'prefix' => 'INV-']),
                'order_type' => $request['orderType'],
                'customer_type' => $request['customerType'],
                'taxpayer_type' => $request['customerTaxStatus'],
                'description' => $request['description'],
                'status' => '1',
                'created_by' => Auth::id(),
            ]);

         /************ Insert Order Id In Order Relation *******************/

            $orderRelation=OrderRelation::create([
                'order_id' => $order->id,
                'status' => '1',
                'created_by' => Auth::id(),
            ]);





         if ($request->filled('enquiryNo')) {

         /************ Insert Enquiry Id In Order Relation if Enquiry Id exists *******************/

         $enquiry=Enquiry::where('enquiry_id',$request->enquiryNo)->first();
            $orderRelation->enquiry_id=$enquiry->id;
                $orderRelation->save();
        }



         /************ Insert Bank Dealer Id In Order Relation If Order Type Bank *******************/

         if($order->customer_type=="Bank")
            {
                $orderRelation->dealer_id=$request['bankAgent'];
                 $orderRelation->save();
            }

        /************ Insert Corporate Id In Order Relation If Order Type Bank *******************/

            if($order->customer_type=="Corporate")
            {
                $orderRelation->corporate_id=$request['corporate'];
                $orderRelation->save();
            }

          /************ Update Or Create Customer *******************/

            $customer=Customer::updateOrCreate(
                ['contact' => $request['customerContact']],
                ['name' => $request['customerName'],
                 'cnic' => $request['customerCnic'],
                 'address' => $request['customerAddress'],]
            );

         /************ Insert Customer Id In Order Relation *******************/

            $orderRelation->customer_id=$customer->id;
            $orderRelation->save();


            /************ Create Inventory If Order Type Booking *******************/

            if ($order->order_type=="Booking") {
                $productVersionModel=ProductVersion::find($request['version']);
                $inventory=Inventory::create([
                    'product_version_id' => $productVersionModel->id,
                    'type' => 'Booking',
                    'color' => $request['color'],
                    'current_status' => Config::get('constants.pending'),
                    'status' => '1',
                    'created_by' => Auth::id(),
                ]);

             /************ Attach Inventory With Order In Order Item Model *******************/

                $orderItem=OrderItem::create([
                    'order_id' => $order->id,
                    'inventory_id' => $inventory->id,
                    'quantity' => '1',
                    'status' => '1',
                    'created_by' => Auth::id(),
                ]);

            }

         /************ Order Type Allocation Just Attach Inventory *******************/

            else
            {

            /************ Attach Inventory With Order In Order Item Model and change Inventory Status *******************/
                $orderItem=OrderItem::create([
                    'order_id' => $order->id,
                    'inventory_id' => $request['inventoryItem'],
                    'quantity' => '1',
                    'status' => '1',
                    'created_by' => Auth::id(),
                ]);

                $inventory=Inventory::find($request['inventoryItem']);
                $inventory->current_status=Config::get('constants.product_sold');

                $inventoryInfo = new InventoryInfo();
                $inventoryInfo->inventory_id = $request['inventoryItem'];
                $inventoryInfo->key = 'current_status';
                $inventoryInfo->vlaue = Config::get('constants.product_sold');
                $inventoryInfo->sub_value = time();
                $inventoryInfo->info_type = 'status-change';
                $inventoryInfo->status = '1';
                $inventoryInfo->created_by = Auth::id();
                $inventoryInfo->Save();


            }


            /************ Add Invoice Price *******************/

              $invoicePrice=$this->addCharges($order,'Invoice Price',$request['basicPrice']);

            /************ Add Tax Amount *******************/

              $taxAmount=$this->addCharges($order,'Tax Amount',$request['advanceTax']);

               /************ Add Handelling Charges  *******************/

            if ($request->filled('handelingCharges')) {

                $otherCharges=$this->addCharges($order,'Handeling Charges',$request['handelingCharges']);

            }

            /************ Add Waranty Price *******************/

            if ($request->filled('warrantyPricePlanId')) {

                $warrantyPrice=$this->addCharges($order,'Warranty Price',$request['warrantyPrice']);

                /************ Insert Customer Id In Order Relation *******************/

                    $orderRelation->extended_warranty_id=$request->warrantyPricePlanId;
                    $orderRelation->save();

            }

             /************ Add Insurance Price *******************/

             if ($request->filled('insurancePriceId')) {

                $insurancePrice=$this->addCharges($order,'Insurance Price',$request['insurancePrice']);

                /************ Insert Customer Id In Order Relation *******************/

                    $orderRelation->insurance_program_id=$request->insurancePriceId;
                    $orderRelation->save();

            }

            /************ Add Registration Fee  *******************/

            if ($request->filled('registrationFeeId')) {

                $registrationFee=$this->addCharges($order,'Registration Fee',$request['registrationFee']);

                /************ Insert Customer Id In Order Relation *******************/

                    $orderRelation->registration_fee_id=$request->registrationFeeId;
                    $orderRelation->save();

            }

            /************ Add jumbo pack Charges  *******************/

            if ($request->filled('jumboPack')) {

                $otherCharges=$this->addCharges($order,'JumboPack Charges',$request['jumboPack']);

            }

            /************ Add Other Charges  *******************/

            if ($request->filled('otherCharges')) {

                $otherCharges=$this->addCharges($order,'Other Charges',$request['otherCharges']);

            }

             /************ Add Total Amount  *******************/

            if ($request->filled('totalAmount')) {

                $totalAmount=$this->addCharges($order,'Total Amount',$request['totalAmount']);

            }

             /************ Add Payment Amount  *******************/


             $payment=Payment::create([
                'order_id' => $order->id,
                'type' => 'Debit',
                'payment_mode' => $request['paymentType'],
                'amount' => $request['paymentAmount'],
                'status' => '1',
                'created_by' => Auth::id(),
            ]);


            if ($request->filled('docs')) {

                /************ Store Order Docs Path *******************/

                $data=array();

                for ($i=0; $i <count($request->docs) ; $i++) {

                    $mimeType= substr(strrchr($request->docs[$i],'.'),1);

                    $dataArray=array('order_id'=>$order->id,
                            'doc_type'=>'Doc',
                            'doc_path'=>$request->docs[$i],
                            'mime_type'=>$mimeType,
                            'status'=>'1',
                            'created_by'=>Auth::id(),
                            'created_at'=> date('Y-m-d H:i:s') ,
                             'updated_at' => date('Y-m-d H:i:s'));

                            array_push($data,$dataArray);
                        }

                        $docs= OrderDoc::insert($data);

               }

        DB::commit();
        return response()->json(['success' => "Order $order->invoice_no added succesfully"], 200);

        } catch(Exception $e){


                DB::rollback();
                return response()->json([
                    'error' => $e->errorInfo[2]
                ], 405);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
       $imageDocs=OrderDoc::where('order_id',$order->id)
       ->where('mime_type','png')
       ->orWhere('mime_type','jpg')
       ->get();


       $pdfDocs=OrderDoc::where('order_id',$order->id)
       ->where('mime_type','pdf')
       ->get();


       $otherDocs=OrderDoc::where('order_id',$order->id)
       ->orWhere('mime_type','docx')
       ->orWhere('mime_type','xlsx')
       ->get();

        return view('orders.order-show',compact('order','imageDocs','pdfDocs','otherDocs'));
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

    /************ Add Order Charges *******************/

    public function addCharges($order,$chargeType,$amount)
    {

         return OrderCharge::create([
            'order_id' => $order->id,
            'charge_type' => $chargeType,
            'amount' => $amount,
            'status' => '1',
            'created_by' => Auth::id(),
        ]);
    }

      // ***************************** uploads Docs **************************



      public function UploadDocs(Request $request)
      {
          // The incoming request is valid...

          // Retrieve the validated input data...

       //    $validated = $request->validated();
          // **************** get the original image name here 8

            $fileNameExt = $request->file->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.Str::uuid().'.'.$fileExt;

            $filePath = $request->file->storeAs('uploads/OrderDocs' , $fileNameToStore);

            return $filePath;

      }

    /********  Orders Datatable ******************/


    public function datatable()
    {
        return response()->json(Order::with('order_relation.customer','order_item.inventory.productVersion.product')->get());
    }

    /********  Orders Invoice ******************/

    public function invoice(Order $order)
    {
        $orderCharges=$order->order_charge;
        $orderCharges = $orderCharges->mapWithKeys(function ($item) {
            return [$item['charge_type'] => $item['amount']];
        });
        $createdBy=User::find($order->created_by);
        return view('orders.order-invoice',compact('order','orderCharges','createdBy'));
    }

}
