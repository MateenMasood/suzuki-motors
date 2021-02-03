{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : oct-31-2020 ************************}
{{-- **********************file-name: employee-create *********************** --}}
{{-- **********************  controller-name:  Users/EmployeeController  *** --}}

@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')


    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }} " /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " /> --}}

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/enquiry-create.css') }} " />

@endsection



@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Create Employee</h1>
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

        <div class="row">

            <div class="col-12">


                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Create Employee</h5>
                        <form id="formCreate"  enctype="multipart/form-data" >
                            {{-- {{ csrf_field() }} --}}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">

                                {{-- *************** User first name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="firstName">First Name </label>
                                        <input type="text" class="form-control" id="firstName"
                                            name="firstName" required>

                                    </div>
                                </div>

                                {{-- *************** user last name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lastName">Last Name </label>
                                        <input type="text" class="form-control" id="lastName"
                                            name="lastName" required>

                                    </div>
                                </div>


                            </div>

                            {{-- ******************************** end row *************** --}}

                            <div class="row">

                                {{-- *************** user email   ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" id="email"
                                            name="email" required>

                                    </div>
                                </div>

                                {{-- *************** user contact no  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="phoneNo">Phone No </label>
                                        <input type="text" class="form-control" id="phoneNo"
                                            name="phoneNo"  maxlength="12" required>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                {{-- *************** user password   ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="password">Password </label>
                                        <input type="password" class="form-control" id="password"
                                            name="password" required>

                                    </div>
                                </div>

                                {{-- *************** confirm password   ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="password">Confirm Password </label>
                                        <input type="password" class="form-control" id="confirmPassword"
                                            name="confirmPassword" required>

                                    </div>
                                </div>

                            </div>

                            <div class="row">


                                {{-- *************** user cnic   ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="email">CNIC </label>
                                        <input type="text" class="form-control" id="cnic"
                                            name="cnic" maxlength="15" required>

                                    </div>
                                </div>

                                {{-- *************** user date of birth  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="phoneNo">Date of Birth </label>
                                        <input type="text" class="form-control datepicker" id="dob"
                                            name="dob" required>

                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                 {{-- ************* department   *************** --}}

                                 <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="department"> Department </label>
                                            <select class="form-control " data-width="100%" id="department" name="department" required>
                                                <option value="">Select</option>

                                            </select>

                                    </div>
                                </div>


                                {{-- ************* role  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchId">Branch </label>
                                            <select class="form-control" data-width="100%" id="branch" name="branch" required>
                                                <option value="">Select</option>
                                            </select>


                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchId">Role </label>
                                            <select class="form-control" data-width="100%" id="role" name="role" required>
                                                <option value="">Select</option>
                                            </select>


                                    </div>
                                </div>

                            </div>

                             {{-- ************************** user address ************** --}}
                             <div class="row mb-3">

                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group ">
                                        <label for="address">Address </label>
                                        <input type="text" class="form-control" id="address"
                                            name="address" required>

                                    </div>
                                </div>

                            </div>

                            <button type="submit" id="submit" class="btn btn-primary mb-0">Submit</button>
                        </form>

                    </div>
                </div>



            </div>
        </div>
    </div>
</main>

@endsection


{{-- ******************* all scripts file here ****************** --}}
@section('js')

    <script src="{{ asset('assets/js/vendor/bootstrap-tagsinput.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notify.js') }}"></script>


   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

    <script src="{{ asset('assets/CustomJs/Users/employee-create.js') }}"></script>




@endsection


