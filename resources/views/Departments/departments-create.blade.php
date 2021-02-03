{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood updated by Malik Ahsan************ --}}
{{-- **************** date : sep-26-2020 updated 08-nov-2020 ************************}
{{-- **********************file-name: product-create *********************** --}}
{{-- **********************  controller-name:  Products/ProductController  *** --}}

@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " />

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/bank-create.css') }} " />

@endsection



@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Departments List</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">All Departments </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Department</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>

            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Create Departments</h5>
                        <form id="formCreate">
                            {{-- {{ csrf_field() }} --}}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">

                                {{-- *************** department name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="bankName">Name </label>
                                        <input type="text" class="form-control" id="departmentName"
                                            name="name" required>

                                    </div>
                                </div>

                            </div>
                            {{-- ******************************** end row *************** --}}

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

    <script src="{{ asset('assets/CustomJs/Departments/departments-create.js') }}"></script>




@endsection
