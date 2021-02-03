{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : nov-08-2020 ************************}
{{-- **********************file-name: role-permissions *********************** --}}
{{-- **********************  controller-name:  Rback/Roles/RoleController  *** --}}

@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

@endsection



@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Assign Permission To Role</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>


            </div>
        </div>
{{-- @for ($i = 0; $i < $count; $i++)

@endfor --}}
        <div class="row">

            <div class="col-12">

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Assign Permissions</h5>

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" width="70%">Permissions </th>
                                        <th scope="col">Create</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @for ($i=0; $i < count($allPermissions) ; $i++)


                                    <tr>
                                        <th scope="row">{{ substr($allPermissions[$i]['name'] , 0 , -6)}}</th>
                                        <td>
                                            <div class="custom-switch custom-switch-secondary mb-2 custom-switch-small">
                                                <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                                    value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus"  >
                                                <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-switch custom-switch-secondary mb-2 custom-switch-small">
                                                <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                                    value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus" >
                                                <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-switch custom-switch-secondary mb-2 custom-switch-small">
                                                <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                                    value="{{$allPermissions[$i++]['id'] }}" id="permissionStatus{{$i}}" name="permissionStatus" >
                                                <label class="custom-switch-btn" for="permissionStatus{{$i}}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-switch custom-switch-secondary mb-2 custom-switch-small">
                                                <input class="custom-switch-input"  type="checkbox" onchange="assignPermission('{{$allPermissions[$i]['id'] }}')" @for($j=0 ; $j<count($roleAllPermissions); $j++) {{ ($roleAllPermissions[$j]['id'] == $allPermissions[$i]['id']) ? 'checked':''}} @endfor
                                                    value="{{$allPermissions[$i]['id'] }}" id="permissionStatuss{{$i}}" name="permissionStatus" >
                                                <label class="custom-switch-btn" for="permissionStatuss{{$i}}"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    @endfor

                                </tbody>
                            </table>

                    </div>
                </div>



            </div>
        </div>
    </div>
</main>

@endsection


{{-- ******************* all scripts file here ****************** --}}
@section('js')

    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notify.js') }}"></script>


   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

    <script src="{{ asset('assets/CustomJs/Rback/Roles/AssignPermissions/role-permissions.js') }}"></script>




@endsection


