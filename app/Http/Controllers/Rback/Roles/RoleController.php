<?php

namespace App\Http\Controllers\Rback\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRole;
use \Spatie\Permission\Models\Permission;
use JavaScript;
use \Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        return \View::make('Rback.Roles.roles-list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \View::make('Rback.Roles.role-create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
       $validatedData = $request->validated();

    //    return $validatedData;
       $roleModel = new Role();

       $roleModel->name = $validatedData['role'];
       $roleModel->guard_name = 'web';
   // return $roleModel->save();
       if ($roleModel->save()) {
            return \response()->json(['status'=>'true' , 'message'=>'Role added successfully' ]);

       }else{
        return \response()->json(['status'=>'error' , 'message'=>'Error occured please try again !Error code DFG454' , 'inventoryStatus']);


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

    // ********************* get all roles *************************

    public function datatable()
    {
        // return Role::all();
        return response()->json(Role::all());

    }

    // *********************** roles select2 *******************

    public function select2Roles(Request $request)
    {
       return response()->json(Role::where('name','like',"%$request->searchTerm%")->get(['id' , 'name']));

    }

    // ********************* sort the permissions ***********************

    private static  function cmp($a, $b)
    {

        return strcmp($a["name"] , $b['name']);
    }

    // ********************** display all permissions to show permission page *************

    public function assignPermissionsShow($id)
    {
        // ****************** get all permissions **************

        $allPermissions = Permission::all()->toArray();
        $roleId = $id;
        // ******************************



        usort($allPermissions, array($this,'cmp'));
        $count = count($allPermissions);
        for ($i=0; $i < $count ; $i+=4 ) {
            $allPermissions[$i];
            $temp = $allPermissions[$i+1];
            $allPermissions[$i+2];
            $allPermissions[$i+1] = $allPermissions[$i+3];
            $allPermissions[$i+3] = $temp;

        }

        JavaScript::put([
            'roleId' => $id,

        ]);

        $roleAllPermissions = Role::findByName(Role::find($id)->name)->permissions;

        return \View::make('Rback.Roles.AssignPermissions.role-permissions' , compact('allPermissions' , 'roleAllPermissions'));
    }

    // ************************ assign permission to eacch role *****************

    public function assignPermissionToRole(Request $request)
    {
        $validatedData = $request->validate([
            'permission' => 'required|numeric',
            'role' => 'required|numeric',
            'status' => 'required',
        ]);

        $role = Role::find($validatedData['role']);
        $permission = Permission::find($validatedData['permission']);

        if ($validatedData['status'] == 'checked') {

            $role->givePermissionTo($permission->name);
            return 'permission give succfully';
        }else{
            $role->revokePermissionTo($permission->name);
            return 'permission revoke succfully';

        }
    }
}
