<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBranch;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
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
        return view('branches.branches-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.branch-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranch $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try
        {

    $branch= Branch::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'contact' => $validated['contact'],
        'dealer_code' => $validated['dealerCode'],
        'key_person1_contact' => $validated['keyPerson1Contact'],
        'key_person2_contact' => $validated['keyPerson2Contact'],
        'address' => $validated['address'],
        'status' => '1',
        'created_by' => Auth::id(),
    ]);

        DB::commit();
        return \response()->json(['success'=>'branch added successfully']);

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


    /********  Branches Datatable ******************/

    public function datatable()
    {
        return response()->json(Branch::all());
    }

    /********  Branches Select2 ******************/

    public function select2Branches(Request $request)
    {
        return response()->json(Branch::where('name','like',"%$request->searchTerm%")->get(['id','name']));
    }
}
