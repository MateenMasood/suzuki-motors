
{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : nov-01-2020 ************************}
{{-- **********************file-name: employee-show *********************** --}}
{{-- **********************  controller-name:  Users/EmployeeController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}" />

@endsection

{{-- @section('page-header')


@endsection --}}


@section('content')


<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Product Details</h1>
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
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-xl-8 col-left">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="glide details">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <img alt="detail" src="{{asset('assets/img/profile-pic-l.jpg')}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">

                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{asset('assets/img//profile-pic-l.jpg')}}"
                                            class="responsive border-0 border-radius img-fluid" />
                                    </li>
                                </ul>
                            </div>
                            <div class="glide__arrows" data-glide-el="controls">
                                <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i
                                        class="simple-icon-arrow-left"></i></button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i
                                        class="simple-icon-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                    aria-controls="first" aria-selected="true">User Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">Branch Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">Department Info</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="first" role="tabpanel"
                                aria-labelledby="first-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->user->first_name }}  {{ $employee->user->last_name }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- ******************* user email  --}}

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User Email </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->user->email }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>

                                </div>
                                    {{-- ****************** user contact --}}

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User Contact </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->user->contact }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>

                                </div>

                                {{-- ******************** user cnic  --}}

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User CNIC </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->cnic }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>

                                </div>

                                 {{-- ******************** user date of birth  --}}

                                 <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User date of birth </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->date_of_birth }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-3  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> User Address </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->address }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>

                                </div>

                                {{-- *************** id of enquiry ************ --}}
                               {{-- <input type="hidden" name="enquiryId" id="enquiryId" value="{{ $enquiry->id  }}"> --}}

                                <br />

                            </div>
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Branch Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->name }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Dealer Code </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->dealer_code }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Branch Contact </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->contact }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Branch Email </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->email }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Key Person1 contact </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->key_person1_contact }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Key Person2 contact </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->key_person2_contact }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Address </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->branch->address }} </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            {{-- ********************** third tab ********************* --}}
                            <div class="tab-pane fade " id="third" role="tabpanel"
                                aria-labelledby="third-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Department Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $employee->department->name }}  </p>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- *********************** right card ************* --}}

            <div class="col-12 col-md-12 col-xl-4 col-right">
                <div class="card mb-4">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button">
                            <i class="simple-icon-refresh"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        {{-- <div class="mb-3">
                            <div class="post-icon mr-3 d-inline-block">
                                <p class="font-weight-bold">Enquiry Description</p>
                            </div>

                        </div> --}}
                        {{-- <p class="mb-3"> --}}
                            {{-- {{ $enquiry->description }} --}}
                        {{-- </p> --}}
                        {{-- <p class="text-muted text-small mb-2">Tags</p> --}}
                        {{-- <p class="mb-3">
                            <a href="#">
                               <span class="font-weight-bold"> Enquiry Status :  </span> &nbsp; <span class="badge badge-pill badge-secondary mb-1"></span>
                            </a>
                        </p> --}}

                        {{-- <p>
                            <div class="row align-center text-center">
                                <div class="col-md-12 col-lg-12">
                                    <button type="button" class="btn btn-success btn-sm mb-1" id="mature" value="mature">Mature</button>
                                    <button type="button" class="btn btn-danger btn-sm mb-1" id="cancel" value="cancel">Cancel</button>

                                </div>

                            </div> --}}


                        {{-- </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


{{-- ******************* all scripts file here ****************** --}}
@section('js')


<script src="{{ asset('assets/js/vendor/baguetteBox.min.js') }}"></script>

   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

<script src="{{ asset('assets/CustomJS/Users/employee-show.js') }}"></script>


@endsection
