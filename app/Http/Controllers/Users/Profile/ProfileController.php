<?php

namespace App\Http\Controllers\Users\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePassword;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $employee = Employee::where('user_id' , Auth::id())->with("user" , "branch" , "department")->first();
        return \View::make('Users.Profile.profile-show' , compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    // ********* chnage password ******************

    public function changePassword(UpdatePassword $request)
    {


        if(Auth::Check())
            {
                try {

                             $validatedData = $request->validated();



                            $currentPassword = Auth::user()->password;

                                if(Hash::check($validatedData['oldPassword'], $currentPassword))
                                    {
                                        $userId = Auth::User()->id;
                                        $objUser = User::find($userId);
                                        $objUser->password = Hash::make($validatedData['newPassword']);
                                        $objUser->save();
                                        return response()->json(['status'=>'true' , 'message'=>'you update your password successfully'], 200);

                                    }
                                    else
                                        {
                                            return response()->json(['status'=>'flase' , 'message'=>'please enter correct curreent password'], 200);
                                        }

                } catch (\Exception $e) {
                    return response()->json(['status'=>'flase' , 'message'=>$e], 200);

                }
            }
            else
            {
                return redirect()->to('/');
            }

    }

}
