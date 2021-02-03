{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : oct-31-2020 ************************}
{{-- **********************file-name: corporate-create *********************** --}}
{{-- **********************  controller-name:  Corporates/CorporateController  *** --}}

@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " />

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/product-create.css') }} " />

@endsection

@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Create Corporate</h1>
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
                        <h5 class="mb-4">Create Products</h5>
                        <form id="formCreate"  enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">

                              {{-- ************* corporates type  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="company"> Corporate Type </label>
                                            <select class="form-control select2-single" data-width="100%" id="type" name="type" required>
                                                <option value="">Select</option>
                                               <option value="Private"> Private </option>
                                               <option value="government"> Government </option>

                                            </select>

                                    </div>
                                </div>

                                {{-- *************** name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name">Name </label>
                                        <input type="text" class="form-control" id="name"
                                            name="name" required>

                                    </div>
                                </div>


                            </div>
                            {{-- ******************************** end row *************** --}}

                            <div class="row">


                                {{-- *************  contact  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="contact">Contact </label>
                                        <input type="text" class="form-control" id="contact"
                                            name="contact" maxlength="12" required>

                                    </div>
                                </div>

                                {{-- *************  email  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="email">Email </label>
                                        <input type="text" class="form-control" id="email"
                                            name="email" required>

                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                {{-- *************** texxt ****************** --}}

                                <div class="col-md-12 col-lg-12">

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" rows="2" required id="address" name="address" required></textarea>

                                    </div>
                                </div>

                                {{-- ******************* image file name ********--}}
                                <input type="hidden" id="image" name="image">

                            </div>

                            <div class="row mb-3">

                                {{-- *************** texxt ****************** --}}

                                <div class="col-md-12 col-lg-12">

                                    <div class="form-group">
                                        <label for="address">Description</label>
                                        <textarea class="form-control" rows="2" required id="description" name="description" required></textarea>

                                    </div>
                                </div>

                                {{-- ******************* image file name ********--}}
                                <input type="hidden" id="image" name="image">

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
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notify.js') }}"></script>


   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

    <script src="{{ asset('assets/CustomJs/Corporates/corporate-create.js') }}"></script>




@endsection


