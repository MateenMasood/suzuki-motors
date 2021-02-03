<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductImage;
use App\Models\Product;
use App\Models\ProductVersion;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use JavaScript;
//******** Created by Mateen Masood *************//
//******** Modified by Muhammad Ahsan Aftab ***********//
use Illuminate\Support\Facades\Auth;
Use Exception;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return \View::make('Products.product-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Products.product-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //  StoreProduct
    public function store(StoreProduct $request)
    {

        // ***************** adding product intodatabse ******************
        //We are gonna need transaction
        //The reason behind that is the fact that againset each products
        //** at least one or many variants must be stored in database
        //** in case of any failure no data must be stored
        // The incoming request is valid...
       // Retrieve the validated input data...
       $validated = $request->validated();

       //Starting a transaction
       DB::beginTransaction();

       //Inserting into products table
       try{
        $product = Product::create([
            'branch_id' => $validated['branchId'],
            'name' => $validated['name'],
            'company' => $validated['company'],
            'description' => $validated['description'],
            'base_image' => $validated['image'],
            'status' => '1',
            'created_by' => Auth::id()
          ]);

          //Inserting models and versions
          $models = $validated['model'];
          $versions  = $validated['version'];
    //    $product->branch_id = $validated['branchId'];
    //    $product->name = $validated['name'];
    //    $product->company = $validated['company'];
    //    $product->description = $validated['description'];
    //    $product->base_image = $validated['image'];
    //    $product->status = '1';
    //    $product->created_by = Auth::id();

          //Array to keep track of inserts in db for product versions
          $productVersionsInsert =  array();

          foreach ($models as $key => $model) {
            //Since key is same for both models and versions
            $productVersionsInsert[] = ProductVersion::create([
              'product_id' => $product["id"] ,
              'model' => $model ,
              'variant_label' => $versions[$key] ,
              'status' => '1' ,
              'created_by' => '2'
            ]);
          }

          DB::commit();
          return \response()->json(['message'=>'Product successfully added.']);
        }catch(Exception $e){

          DB::rollback();
          return response()->json([
            'errors' => array($e->errorInfo[2])
        ], 405);
        //   return \response()->json(["errors"=>array($e->getMessage()) ]);
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

        $productInfo=Product::find($id);
        // $productInfo = Product::with(['productVersion'=> function($query){
        //   return $query->where('status' , '=' , 1 );
        // }])->find($id);

        // $productInfo = array();
        // $branch_idproductInfo ->branch_id ;
        // $productInfo ->name ;
        // $productInfo ->company ;
        // $productInfo ->description ;
        // $productInfo ->base_image ;
        return \View::make('Products.product-show'  , compact('productInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productInfo = Product::with(['productVersion'=> function($query){
          return $query->where('status' , '=' , 1 );
        }])->find($id);
        JavaScript::put([
            'id' => $id,
          ]);
        // $productInfo = array();
        // $branch_idproductInfo ->branch_id ;
        // $productInfo ->name ;
        // $productInfo ->company ;
        // $productInfo ->description ;
        // $productInfo ->base_image ;

        return \View::make('Products.product-edit'  , compact('productInfo'));
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
      //Starting a transaction
      DB::beginTransaction();

      try{
        //Updating products table

        //Fetching product
        $product = Product::find($id);

        //Updating product
        $product->branch_id = $request->branchId;
        $product->company = $request->company;
        $product->description = $request->description;
        $product->base_image = $request->image;
        $product->name = $request->name;

        //Saving
        $productUpdated = $product->save();
        if(!$productUpdated)
        {
          //Product was not updated
          throw new Exception("Something went wrong while updating.Code :3628$@");
        }
        //Updating variants
        //Three cases
        //User has deleted some variants
        $toBeDeleted = json_decode($request->tobedeleted);
        if(count($toBeDeleted) > 0)
        {
            $rowsAffected = ProductVersion::whereIn("id", $toBeDeleted)->update(["status"=>0]);
            if($rowsAffected < 1)
              throw new Exception("Something went wrong while deleting a variant.Code :92#@65");
        }
        $vIds = $request->variantIds;
        //User has not changed variants

        //User has added more variants

        //Where ids are posted update them
        //where we dont have ids just create them
        for($i=0; $i< count($request->model) ; $i++)
        {
          if($request->model[$i])
            {
              if(isset($vIds[$i]))
                {
                  // Update occurs
                  $rowsAffected = ProductVersion::where("id", $vIds[$i])->update(["model"=>$request->model[$i],"variant_label"=>$request->version[$i]]);
                  if($rowsAffected < 1)
                    throw new Exception("Something went wrong while updating a variant.Code :9!5@35");

                }else{
                    // Insert occurs
                    $vCreated = ProductVersion::create([
                                  'product_id' => $id ,
                                  'model' => $request->model[$i] ,
                                  'variant_label' => $request->version[$i] ,
                                  'status' => '1' ,
                                  'created_by' => '2'
                                ]);
                    if(!$vCreated)
                    {
                      throw new Exception("Something went wrong while updating versions.Code : *32^43");
                    }
                  }
              }
              // echo "Value is set".$request->model[$i]." Version is :". $request->version[$i];
            }//End of variant for loop


        DB::commit();
        return \response()->json(['message'=>'Product successfully updated.']);
      }catch(Exception $e){
        DB::rollback();
        return $e;
      }
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


    // ******************** product datatable ********

    public function datatable()
    {
        // $productAllData = new Product;

        // // ***************** get and return all products **********
        // return $productAllData->all();

        return response()->json(Product::with('branch')->get());


    }

    // ********************** uploading product image ******************

    public function fileUpload(StoreProductImage $request)
    {
        // The incoming request is valid...

        // Retrieve the validated input data...

        $validated = $request->validated();

        // **************** get the original image name here 8

        $imageName = time().'.'.$request->file->extension();

        $imagePath = $request->file->storeAs('uploads/ProductImages' , $imageName);

        return $imagePath;
        // *************** return image name with path

    }

    // ************************* select2 products *********

    public function select2Products(Request $request)
    {
       return response()->json(Product::where('name','like',"%$request->searchTerm%")->get(['id' , 'name']));
    }
}
