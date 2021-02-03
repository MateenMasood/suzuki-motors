<?php

namespace App\Http\Controllers\Enquiries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEnquiry;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Enquiry;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Exception;

class EnquiryController extends Controller
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
        return \View::make('Enquiries.enquiries-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Enquiries.enquiry-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnquiry $request)
    {


        // ***************** adding rnquiry into databse ******************

        // The incoming request is valid...

       // Retrieve the validated input data...
        $validated = $request->validated();

        // ********** start transction ************
        DB::beginTransaction();

        try {

            // *********** store customer info ************

            $customerModel = new Customer();
            $customerModel->name       = $validated['customerName'];
            $customerModel->contact    = $validated['phoneNo'];
            $customerModel->status     = '1';
            $customerModel->created_by = Auth::id();

            $customerModel->save();
            $customerId = $customerModel->id;


            // ****************** store enquiry info *********

            $enquiryModel = new Enquiry();

            $enquiryModel->enquiry_id = $id = IdGenerator::generate(['table' => 'enquiries','field'=>'enquiry_id', 'length' => 10, 'prefix' =>'ENQ-']);
            $enquiryModel->customer_id = $customerId;
            $enquiryModel->product_version_id = $validated['version'];
            $enquiryModel->description = $validated['description'];
            $enquiryModel->enquiry_status = Config::get('constants.pending');
            $enquiryModel->status = '1';
            $enquiryModel->created_by = Auth::id();

            $enquiryModel->save();

            DB::commit();

            return response()->json("Enquiry $enquiryModel->enquiry_id has been added successfully.");
        } catch (Exception $e) {

            DB::rollBack();
            return response()->json([  "error" =>$e->errorInfo[2]  ] ,406);

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


         $enquiry=Enquiry::find($id);

        return \View::make('Enquiries.enquiry-detail')->with(compact('enquiry'));
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

    // *************** enquiry view datatable ***************

    public function datatable()
    {


        return Enquiry::Where('created_by' , Auth::id())->with('customer','ProductVersion.product')->get();
    }

    // ******************* cancel the enquiry status here *****************

    public function cancel(Request $request)
    {
        // return $request->all();
        $validateData = $request->validate([
            'status'=> 'required',
            'id'=> 'required'
        ]);

        $enquiry = Enquiry::find($validateData['id']);

        $enquiry->enquiry_status = $validateData['status'];

        if($enquiry->save()){
            return true;
        }else{
            return false;
        }


    }

    public function matureEnquiry(Request $request)
    {
         // return $request->all();
         $validateData = $request->validate([
            'id'=> 'required',
            'status'=> 'required',

        ]);
        $enquiry = Enquiry::find($validateData['id']);

        if ($enquiry->enquiry_status == 'cancel') {
            return 'sorry! you can mature your enquiry because your enquiry is already canceled . error code : STWE34ER';
        }elseif($enquiry->enquiry_status == 'mature'){
            return 'your enquiry is already mature .';
        }else{
            $enquiry->enquiry_status = $validateData['status'];

            if($enquiry->save()){
                session(['maturedEnquiryId' => $enquiry->id ]);
                return 'true';
            }else{
                return 'false';
            }

        }
        // return $enquiry->id;
    }



}
