<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

use App\Http\Requests\StoreDepartment;
use  Illuminate\Support\Facades\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \View::make('Departments.departments-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return \View::make('Departments.departments-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartment $request)
    {
        //*********Adding departments

        //The incomming request is validated
        //Fetching the validated data
        $validated = $request ->validated();

        $department = new Department();
        // return $request;

        $department->name = $validated['name'];
        $department->status = '1';
        $department->created_by = '1';

        if($department->save()){
          return true;
        }else{
          return false;
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
     * Creating a printable interface.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        dd("hello");
        return \View::make('orders.so-form');

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
        //No validations yet
        $bodyContent = json_decode($request->getContent()) ;

         //Fetching department
         $Department = Department::find($bodyContent->id);

         //Updating Department
         $Department->name = $bodyContent->name;
 
         //Saving
         $DepartmentUpdated = $Department->save();

         $response = array('message' => "Error occured while updating." );
         $statusCode = 401;

         if($DepartmentUpdated)
         {
            $response = array('message' => "updated successfully." );
            $statusCode = 201;

         }
         return Response::json($response, $statusCode);
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
    //To view Departments
    public function datatable()
    {
        return Department::where('status','1')->get();
    }

    // ******************************* select2 departments *************

    public function select2Department(Request $request)
    {
        return response()->json(Department::where('name','like',"%$request->searchTerm%")->get(['id','name']));

    }
}
