<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\StoreProductImage;
use App\Models\Product;
use Illuminate\Filesystem\Filesystem;

class ProductController extends Controller
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

        // The incoming request is valid...

       // Retrieve the validated input data...
       $validated = $request->validated();
       $product  = new Product();

       $product->branch_id = $validated['branchId'];
       $product->name = $validated['name'];
       $product->company = $validated['company'];
       $product->description = $validated['description'];
       $product->base_image = $validated['image'];
       $product->status = '1';

       if(! $product->save()){
           return false;
       }else{
           return true;
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


    // ******************** product datatable ********

    public function datatable()
    {
        $productAllData = new Product;

        // ***************** get and return all products **********
        return $productAllData->all();

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
        // File::exists($imagePath)?true:false;
        // *************** return image name with path
        // return $request->file->move($imagePath, $imageName);

    }

    // ************************* select2 products *********

    public function select2Products(Request $request)
    {
       return response()->json(Product::where('name','like',"%$request->searchTerm%")->get(['id' , 'name']));
    }
}
