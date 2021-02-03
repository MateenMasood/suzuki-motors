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
                        <h5 class="mb-4">Create Company</h5>
                        <form id="formCreate"  enctype="multipart/form-data" >
                            {{-- {{ csrf_field() }} --}}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">

                                {{-- *************** company name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="firstName">Comapny Name </label>
                                        <input type="text" class="form-control" id="name"
                                            name="name" placeholder="Please enter company name" required>

                                    </div>
                                </div>

                                {{-- *************** comapny email  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="lastName">Comapny Email </label>
                                        <input type="email" class="form-control" id="email"
                                            name="email" placeholder="Please enter company email" required>

                                    </div>
                                </div>


                            </div>

                            {{-- ******************************** end row *************** --}}

                            <div class="row">

                                {{-- *************** ucompany phone no  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="phoneNo"> Company Phone No </label>
                                        <input type="text" class="form-control" id="phoneNo"
                                            name="phoneNo"  maxlength="12" placeholder="Please enter company contact" required>

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                {{-- *************** company address  ********** --}}
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group ">
                                        <label for="password">Company Address </label>
                                        <input type="text" class="form-control" id="address"
                                            name="address" placeholder="Please enter company address" required>

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

    <script src="{{ asset('assets/CustomJS/Add-Ons/InsuranceCompany/insurance-company-create.js') }}"></script>




@endsection


