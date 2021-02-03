<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Employee;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
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
        return \View::make('Users.employees-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Users.employee-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        // return $request;
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {

            $userModel = new User();
            $userModel->first_name = $validatedData['firstName'];
            $userModel->last_name = $validatedData['lastName'];
            $userModel->email = $validatedData['email'];
            $userModel->contact = $validatedData['phoneNo'];
            $userModel->password = Hash::make($validatedData['password']);

            $userModel->save();

            $employeeModel = new Employee();
            $employeeModel->user_id = $userModel->id;
            $employeeModel->department_id = $validatedData['department'];
            $employeeModel->branch_id = $validatedData['branch'];
            $employeeModel->cnic = $validatedData['cnic'];
            $employeeModel->date_of_birth = $validatedData['dob'];
            $employeeModel->address = $validatedData['address'];
            $employeeModel->status = '1';
            $employeeModel->created_by = Auth::id();

            $employeeModel->save();

            $roleModel = Role::find($validatedData['role']);

            $userModel->assignRole($roleModel->name);

            DB::commit();
            return \response()->json(['status'=>'true' , 'message'=>'User created successfully' , 'inventoryStatus']);

        }
        catch (\Illuminate\Database\QueryException $exception) {
            DB::rollback();
            // You can check get the details of the error using `errorInfo`:
            $errorInfo = $exception->errorInfo;

            // Return the response to the client..
            return $errorInfo[2];
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
        $employee=Employee::find($id);

        // return $enquiry;

        return \View::make('Users.employee-show')->with(compact('employee'));
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

    // ********************* get all employee ****************

    public function datatable()
    {
        return \response()->json(Employee::with('user' , 'branch' , 'department')->get(), 200);
    }
}

