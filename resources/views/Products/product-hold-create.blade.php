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

                <h1>Create Product Hold Form</h1>
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
                        <h5 class="mb-4">Hold product</h5>
                        <form id="formCreate"  enctype="multipart/form-data" >
                            {{-- {{ csrf_field() }} --}}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">

                                {{-- *************** customer name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name">Customer Name </label>
                                        <input type="text" class="form-control" id="customerName"
                                            name="customerName" required>

                                    </div>
                                </div>

                                {{-- *************** customer contact no  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name">Customer Phone No </label>
                                        <input type="text" class="form-control" id="customerPhoneNo"
                                            name="customerPhoneNo" required>

                                    </div>
                                </div>


                            </div>

                            {{-- ******************************** end row *************** --}}

                            <div class="row">


                                {{-- ************* product   *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="productName"> Product </label>
                                            <select class="form-control " data-width="100%" id="productName" name="productName" required>
                                                <option value="">Select</option>
                                               {{-- <option value="Suzuki Mehran ">Suzuki Mehran </option> --}}

                                            </select>

                                    </div>
                                </div>


                                {{-- ************* product version model   *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="company"> Version-Model </label>
                                            <select class="form-control " data-width="100%" id="version" name="version" required>
                                                <option value="">Select</option>

                                            </select>

                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                {{-- ************* product item   *************** --}}

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group ">
                                        <label for="color"> Product Color </label>
                                        <select class="form-control"  name="color" id="color" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="red">Red</option>
                                            <option value="white">White</option>
                                            <option value="blue">Blue</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- ****************** product item ************************** --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Inventory Item</label>
                                        <select class="form-control"  name="inventoryItem" id="inventoryItem" data-width="100%">
                                            <option value="">Select</option>

                                        </select>
                                    </div>
                                </div>

                            </div>

                            {{-- ************** product token amount  --}}

                            <div class="row mb-3">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tokenAmount">Token Amount</label>
                                        <input type="text" class="form-control" id="tokenAmount" name="tokenAmount" required>
                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3">

                                {{-- *************** product description ****************** --}}

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="5" required id="description" name="description" required></textarea>

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

    <script src="{{ asset('assets/CustomJs/Products/product-hold-create.js') }}"></script>




@endsection


