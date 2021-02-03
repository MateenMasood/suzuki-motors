<?php

namespace App\Http\Controllers\Corporates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Corporate;
use App\Http\Requests\StoreCorporate;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
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
        return \View::make('Corporates.corporates-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Corporates.corporate-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCorporate $request)
    {
        $validatedData = $request->validated();
        $corporateModel = new Corporate();

        $corporateModel->type = $validatedData['type'];
        $corporateModel->name = $validatedData['name'];
        $corporateModel->contact = $validatedData['contact'];
        $corporateModel->email = $validatedData['email'];
        $corporateModel->address = $validatedData['address'];
        $corporateModel->description = $validatedData['description'];
        $corporateModel->status = '1';
        $corporateModel->created_by = Auth::id();

        if ($corporateModel->save()) {

            return \response()->json(['status'=>'true' , 'message'=>'corporate added successfully' ]);

        }else{
            return \response()->json(['status'=>'false' , 'message'=>'error occured ! please try again ERROR CODE : SDSDF45' ]);

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

    // ************************ get all corporate data ***************

    public function datatable()
    {
        return \response()->json(Corporate::all(), 200);
    }

    /********  Corporates Select2 ******************/

    public function select2Corporates(Request $request)
    {
        return response()->json(Corporate::where('name','like',"%$request->searchTerm%")->get(['id','name']));

    }
}
