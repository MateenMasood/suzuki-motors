
{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : oct-17-2020 ************************}
{{-- **********************file-name: product-hold-show *********************** --}}
{{-- **********************  controller-name:  Products/HoldProductController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}" />


    {{-- ********************* custom css ************************ --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/inventories/inventory-show.css') }}" />



@endsection

{{-- @section('page-header')


@endsection --}}

@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Inventory Details</h1>
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
                                        <img alt="detail" src="{{asset('storage/'.$inventory->ProductVersion->product->base_image)}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">

                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{asset('storage/'.$inventory->ProductVersion->product->base_image)}}"
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
                                <a class="nav-link active" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="true">Product Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">Inventory Info</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Company </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->ProductVersion->product->company }} </p>
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
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->ProductVersion->product->name}} </p>
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
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->ProductVersion->model}} </p>
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
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->ProductVersion->variant_label}} </p>
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
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->ProductVersion->product->description}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                            </div>

                            {{-- ************************** third tabe ********************** --}}

                            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">


                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Engine No </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 " id="engineNumber"> {{ $inventory->engine_no }} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Chassis No </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 " id="chassissNumber"> {{ $inventory->chassis_no}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product color </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->color}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>
                                {{-- ****************** inventory type ************* --}}
                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Inventory type </p>
                                            </div>
                                            <div class="col-md-6 col-lg-9">
                                               <p class="font-weight-medium mb-0 "> {{ $inventory->type}} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- *********************** right card status change card ************* --}}

            <div class="col-12 col-md-12 col-xl-4 col-right">
                <div class="card mb-4">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button">
                            <i class="simple-icon-refresh"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        {{-- <div class="">
                            <div class="post-icon mr-3 d-inline-block">
                                <p class="font-weight-bold">Product Hold Description</p>
                            </div>

                        </div>
                        <p class="mb-3">
                            {{ $productHold->description }}
                        </p> --}}
                        {{-- <p class="text-muted text-small mb-2">Tags</p> --}}
                        <p class="mb-3">
                            <a href="#">
                               <span class="font-weight-bold"> Inventories Status:  </span> &nbsp; <span class="badge badge-pill badge-secondary mb-1" id="defultInventoryStatus">{{$inventory->current_status}}</span>
                               <input type="hidden" id="inventoryId" value="{{$inventory->id}}">
                            </a>
                        </p>

                          {{-- <p> --}}
                            <div class="row">
                                <div class="post-icon mr-3 d-inline-block col-md-12 col-lg-12">
                                    <p class="font-weight-bold">Change Status</p>
                                </div>
                                <div>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary ">
                                            <input type="radio" name="changeInventoryStatus" class="changeIneventoryStatus" id="pending"  value="PENDING"> Pending
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="changeInventoryStatus" class="changeIneventoryStatus" id="transition" value="TRANSITION"> Transition
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="changeInventoryStatus" class="changeIneventoryStatus" id="stockIn" value="STOCKIN"> Stock In
                                        </label>
                                    </div>
                                </div>


                            </div>
                    </div>


                        {{-- </p> --}}
                </div>

                {{-- *********************** add engine number and chassies number when inventory is booked ********* --}}

                <div class="card mb-4" id="bookingInputFields">

                </div>

            </div>


        </div>

            {{-- *******************  add engine and chassis number of a booked car ******** --}}




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
<script src="{{asset('assets/js/vendor/jquery.validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery.validate/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/notify.js')}}"></script>

{{-- ************************ custom js files are included ************** --}}
<script src="{{ asset('assets/CustomJS/inventories/inventory-show.js') }}"></script>


@endsection
