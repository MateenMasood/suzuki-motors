
{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : sep-28-2020 ************************}
{{-- **********************file-name: enquiry-list *********************** --}}
{{-- **********************  controller-name:  Enquiry/EnquiryController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{asset('assets/css/vendor/baguetteBox.min.css')}}" />

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
                                        <img alt="detail" src="{{asset('storage/'.$enquiry->ProductVersion->product->base_image)}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">

                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{asset('storage/'.$enquiry->ProductVersion->product->base_image)}}"
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
                                    aria-controls="first" aria-selected="true">Customer Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">Product Info</a>
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

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Csutomer Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->customer->name }} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>



                                <div class="d-flex flex-row mb-3  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-3">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Csutomer Contact </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->customer->contact }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>


                                        </div>



                                    </div>

                                </div>

                                {{-- *************** id of enquiry ************ --}}
                            <input type="hidden" name="enquiryId" id="enquiryId" value="{{ $enquiry->id  }}">


                                <br />


                            </div>
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Company </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->ProductVersion->product->company }} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->ProductVersion->product->name}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Model </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->ProductVersion->model}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Version </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->ProductVersion->variant_label}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Description </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $enquiry->ProductVersion->product->description}} </p>
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
                        <div class="mb-3">
                            <div class="post-icon mr-3 d-inline-block">
                                <p class="font-weight-bold">Enquiry Description</p>
                            </div>

                        </div>
                        <p class="mb-3">
                            {{ $enquiry->description }}
                        </p>
                        <p class="text-muted text-small mb-2">Tags</p>
                        <p class="mb-3">
                            <a href="#">
                               <span class="font-weight-bold"> Enquiry Status :  </span> &nbsp; <span class="badge badge-pill badge-secondary mb-1">{{$enquiry->enquiry_status}}</span>
                            </a>
                        </p>

                        <p>
                            <div class="row align-center text-center">
                                <div class="col-md-12 col-lg-12">
                                    <button type="button" class="btn btn-success btn-sm mb-1" id="mature" value="mature">Mature</button>
                                    <button type="button" class="btn btn-danger btn-sm mb-1" id="cancel" value="cancel">Cancel</button>

                                </div>

                            </div>


                        </p>
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

   <script src="{{ asset('assets/js/vendor/notify.js') }}"></script>
  <script src="{{ asset('assets/CustomJS/Enquiries/enquiry-detail.js') }}"></script>


@endsection
