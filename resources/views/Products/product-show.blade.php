
{{-- ******************************************************************* --}}
{{-- ************ file created and written by nabeel hassan ************ --}}
{{-- **************** date : nov-5-2020 ************************}
{{-- **********************file-name: product-show *********************** --}}
{{-- **********************  controller-name:  Products/ProductController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}" />


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
                    <div class="top-right-button-container">
                    <a href="{{url('products/'.$productInfo->id.'/edit')}}">
                             <button type="button" class="btn btn-primary btn-lg top-right-button mr-1">Edit</button>
                        </a>
                    </div>
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
                                        <img alt="detail" src="{{asset('storage/'.$productInfo->base_image)}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">

                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{asset('storage/'.$productInfo->base_image)}}"
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
                                    aria-controls="first" aria-selected="true">Product Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">Version-Models</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">Inventory Info</a>
                            </li> --}}
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

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $productInfo->name }} </p>
                                            </div>


                                        </div>



                                    </div>

                                </div>



                                <div class="d-flex flex-row mb-3  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-3">

                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Company </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $productInfo->company }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>


                                        </div>

                                    </div>

                                </div>

                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold">Branch</p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $productInfo->branch->name }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>
                                </div>


                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold"> Product Description </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $productInfo->description }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>

                                        </div>

                                    </div>
                                </div>

                                <br />


                            </div>
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Version</th>
                                            <th scope="col">Model</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productInfo->productVersion as $productVersionModel)
                                        <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$productVersionModel->variant_label}}</td>
                                            <td>{{$productVersionModel->model}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            {{-- *********************** right card ************* --}}

            <div class="col-12 col-md-12 col-xl-4 col-right">
                <div class="card mb-4">
                    <div class="position-absolute card-top-buttons">
                    </div>
                    <div class="card-body">

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

{{-- <script src="{{ asset('assets/CustomJS/Products/product-hold-show.js') }}"></script> --}}


@endsection
