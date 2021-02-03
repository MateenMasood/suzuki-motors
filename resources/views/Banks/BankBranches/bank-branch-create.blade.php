{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : sep-26-2020 ************************}
{{-- **********************file-name: enquiry-create *********************** --}}
{{-- **********************  controller-name:  Enquiries/EnquiryController  *** --}}

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

                <h1> Create Bank Branch</h1>
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
                        <h5 class="mb-4">Create Bank Branch</h5>
                        <form id="formCreate"  enctype="multipart/form-data" >
                            {{-- {{ csrf_field() }} --}}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}


                            <div class="row">

                                {{-- *************** branch name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchName">Branch Name </label>
                                        <input type="text" class="form-control" id="branchName"
                                            name="branchName" required>

                                    </div>
                                </div>

                                 {{-- ************* bank name   *************** --}}

                                 <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="bankId"> Bank </label>
                                            <select class="form-control " data-width="100%" id="bankId" name="bankId" required>
                                                <option value="">Select</option>
                                               {{-- <option value="Suzuki Mehran ">Suzuki Mehran </option> --}}

                                            </select>

                                    </div>
                                </div>




                            </div>

                            <div class="row">
                                {{-- ***************  bank code  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchCode">Branch Code </label>
                                        <input type="text" class="form-control" id="branchCode"
                                            name="branchCode" required>

                                    </div>
                                </div>

                                {{-- *************** branch contact no  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchPhoneNo">Phone No </label>
                                        <input type="text" class="form-control" id="branchPhoneNo"
                                            name="branchPhoneNo" maxlength="12" required>

                                    </div>
                                </div>

                            </div>

                            {{-- ******************************** branch address *************** --}}

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="branchAddress">Branch Address</label>
                                        <textarea class="form-control"  id="branchAddress" name="branchAddress" required></textarea>

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

    <script src="{{ asset('assets/CustomJs/Banks/BankBranches/bank-branch-create.js') }}"></script>




@endsection


