
{{-- ******************************************************************* --}}
{{-- ************ file created and written by nabeel hassan ************ --}}
{{-- **************** date : nov-17-2020 ************************}
{{-- **********************file-name: order-show *********************** --}}
{{-- **********************  controller-name:  Order/OrderController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/print.min.css') }}" />
    <style>
        .scroll{
        height:900px !important;
    }
    </style>



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
                        {{-- <a type="button" href="{{url('/orders/invoice/'.$order->id)}}" class="btn btn-primary btn-lg top-right-button mr-1">
                        <div class="glyph-icon simple-icon-printer d-inline mr-1"></div>Print Invoice
                        </a> --}}

                        <a type="button" href="{{url('/orders/invoice/'.$order->id)}}" class="btn btn-primary btn-lg top-right-button mr-1">
                        <div class="glyph-icon iconsminds-receipt-4 d-inline mr-1"></div>Invoice
                        </a>

                        <div class="btn-group">
                            <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                                <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </div>
                            <button type="button"
                                class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </div>
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
                                        <img alt="detail" src="{{asset('storage/'.$order->order_item->inventory->ProductVersion->product->base_image)}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">

                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{asset('storage/'.$order->order_item->inventory->ProductVersion->product->base_image)}}"
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
                                    aria-controls="first" aria-selected="true">Order Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">Customer Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">Product Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab"
                                    aria-controls="fourth" aria-selected="false">Inventory Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab"
                                    aria-controls="fifth" aria-selected="false">Charges</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab"
                                    aria-controls="sixth" aria-selected="false">Payments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="seventh-tab" data-toggle="tab" href="#seventh" role="tab"
                                    aria-controls="seventh" aria-selected="false">Docs</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <!----------- Order Info Start --------------->
                            <div class="tab-pane fade show active" id="first" role="tabpanel"
                                aria-labelledby="first-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Order Id </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{$order->invoice_no}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Order Type </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{$order->order_type}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->description)
                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">

                                                <p class="font-weight-medium mb-0 font-weight-bold">Order Description</p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $order->description }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="d-flex flex-row mb-2  justify-content-between">

                                    <div class="pl-3 flex-grow-1 mt-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Order Date </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{$order->created_at->format('Y-m-d')}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br />

                            </div>

                         <!----------- Order Info End --------------->


                         <!----------- Customer Info Start --------------->

                         <div class="tab-pane fade" id="second" role="tabpanel"
                                aria-labelledby="second-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Csutomer Name </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{$order->order_relation->customer->name}} </p>
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
                                               <p class="font-weight-medium mb-0 "> {{ $order->order_relation->customer->contact }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold">Csutomer Type</p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $order->customer_type }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>

                                    </div>
                                </div>



                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold">Csutomer Tax Status</p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{ $order->taxpayer_type }} </p>
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>

                                    </div>
                                </div>

                                <br />

                            </div>

                         <!----------- Customer Info End --------------->


                         <!----------- Product Info Start --------------->

                         <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">

                            <div class="d-flex flex-row mb-2  justify-content-between">
                                <div class="pl-3 flex-grow-1 mt-2">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <p class="font-weight-medium mb-0 font-weight-bold"> Company </p>
                                        </div>
                                        <div class="col-md-6 col-lg-9">
                                           <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->productVersion->product->company }} </p>
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
                                           <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->productVersion->product->name}} </p>
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
                                           <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->ProductVersion->model}} </p>
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
                                           <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->ProductVersion->variant_label}} </p>
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
                                           <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->ProductVersion->product->description}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                         <!----------- Product Info End --------------->



                         <!----------- Inventory Info Start --------------->


                         <div class="tab-pane fade" id="fourth" role="tabpanel"
                                aria-labelledby="fourth-tab">

                                <div class="d-flex flex-row mb-2  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-2">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Color </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <p class="font-weight-medium mb-0 "> {{$order->order_item->inventory->color}} </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Engine No </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                @if ($order->order_item->inventory->engine_no)
                                               <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->engine_no }} </p>
                                               @endif
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-row mb-3  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-3">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                                <p class="font-weight-medium mb-0 font-weight-bold"> Chassis No </p>
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                                @if ($order->order_item->inventory->chassis_no)
                                               <p class="font-weight-medium mb-0 "> {{ $order->order_item->inventory->chassis_no }} </p>
                                               @endif
                                            </div>
                                            <p class="font-weight-medium mb-0 mt-3">  </p>
                                        </div>
                                    </div>
                                </div>

                                <br />

                            </div>

                        <!----------- Inventory Info End --------------->


                         <!----------- Charge Info Start --------------->


                         <div class="tab-pane fade" id="fifth" role="tabpanel"
                                aria-labelledby="fifth-tab">

                                @foreach ($order->order_charge as $orderCharge)

                                <div class="d-flex flex-row mb-2  justify-content-between">
                                    <div class="pl-3 flex-grow-1 mt-2">
                                        @if ($orderCharge->charge_type=="Total Amount")
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 border border-primary" style=" border-width:3px !important;">
                                            <p class="font-weight-medium mb-0 font-weight-bold">{{$orderCharge->charge_type}}</p>
                                            </div>
                                            <div class="col-md-3 col-lg-3 border border-primary" style=" border-width:3px !important;">
                                               <p class="font-weight-medium mb-0 font-weight-bold"> {{$orderCharge->amount}} </p>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3">
                                            <p class="font-weight-medium mb-0 font-weight-bold">{{$orderCharge->charge_type}}</p>
                                            </div>
                                            <div class="col-md-3 col-lg-3">
                                               <p class="font-weight-medium mb-0 "> {{$orderCharge->amount}} </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @endforeach

                                <br />

                            </div>

                        <!----------- Charge Info End --------------->


                          <!----------- Payments Info Start --------------->


                          <div class="tab-pane fade" id="sixth" role="tabpanel"
                          aria-labelledby="sixth-tab">

                          @foreach ($order->payment as $orderPayment)
                          <div class="d-flex flex-row mb-2  justify-content-between">
                              <div class="pl-3 flex-grow-1 mt-2">
                                  <div class="row">
                                      <div class="col-md-3 col-lg-3">
                                      <p class="font-weight-medium mb-0 font-weight-bold">{{$orderPayment->payment_mode}}</p>
                                      </div>
                                      <div class="col-md-3 col-lg-3">
                                         <p class="font-weight-medium mb-0 "> {{$orderPayment->amount}} </p>
                                      </div>
                                      <div class="col-md-3 col-lg-3">
                                        <p class="font-weight-medium mb-0 "> {{ $orderPayment->created_at->format('Y-m-d') }} </p>
                                     </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach

                          <br />

                      </div>

                  <!----------- Payments Info End --------------->

                <!----------- Docs Start --------------->

                <div class="tab-pane fade " id="seventh" role="tabpanel" aria-labelledby="seventh-tab">
                   <div class="scroll">

                        @foreach ($imageDocs as $doc)
                        <div class="d-flex flex-row mb-2  justify-content-between">
                        <div class="col-xl-12 col-lg-12 col-12 col-sm-12 mb-4">
                            <div class="card active">
                                <div class="position-relative">
                                    <a href="Pages.Product.Detail.html"><img class="card-img-top" src="{{asset('storage/'.$doc->doc_path)}}" alt="Card image cap"></a>
                                    {{-- <span class="badge badge-pill badge-theme-1 position-absolute badge-top-left">NEW</span>
                                    <span class="badge badge-pill badge-secondary position-absolute badge-top-left-2">TRENDING</span> --}}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="Pages.Product.Detail.html">
                                                <p class="list-item-heading mb-4 pt-1">Chocolate Cake</p>
                                            </a>
                                            <footer>
                                                <p class="text-muted text-small mb-0 font-weight-light">{{$doc->created_at->format('m/d/Y')}}</p>
                                            </footer>
                                        </div>
                                        <div class="col-4">
                                            <div class="top-right-button-container">
                                                <button type="button" id="btnPrintInvoice" class="btn btn-primary" href="#" onclick="printJS('{{asset('storage/'.$doc->doc_path)}}','image')"><div class="glyph-icon simple-icon-printer d-inline mr-1"></div>Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                     @foreach ($pdfDocs as $doc)
                        <div class="d-flex flex-row mb-2  justify-content-between">
                        <div class="col-xl-12 col-lg-12 col-12 col-sm-12 mb-4">
                            <div class="card active">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <a href="Pages.Product.Detail.html">
                                                <p class="list-item-heading mb-4 pt-1">Chocolate Cake</p>
                                            </a>
                                            <footer>
                                                <p class="text-muted text-small mb-0 font-weight-light">{{$doc->created_at->format('m/d/Y')}}</p>
                                            </footer>
                                        </div>
                                        <div class="col-4">
                                            <div class="top-right-button-container">
                                                <button type="button" id="btnPrintInvoice" class="btn btn-primary" href="#" onclick="printJS('{{asset('storage/'.$doc->doc_path)}}')"><div class="glyph-icon simple-icon-printer d-inline mr-1"></div>Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                <br/>
               </div>
                </div>

                <!----------- Docs  End --------------->


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
                        {{-- ************** token amount *********** --}}

                        <div class="">
                            <div class="post-icon mr-3 d-inline-block">
                                <p class="font-weight-bold">Token Amount</p>
                            </div>

                        </div>
                        <p class="mb-3">
                            {{-- {{ $productHold->token_amount }} --}}
                        </p>


                        <div class="">
                            <div class="post-icon mr-3 d-inline-block">
                                <p class="font-weight-bold">Product Hold Description</p>
                            </div>

                        </div>
                        <p class="mb-3">
                            {{-- {{ $productHold->description }} --}}
                        </p>
                        <p class="text-muted text-small mb-2">Tags</p>
                        <p class="mb-3">
                            <a href="#">
                               {{-- <span class="font-weight-bold"> Product Status:  </span> &nbsp; <span class="badge badge-pill badge-secondary mb-1" id="inventoryStatus">{{$productHold->inventory->current_status}}</span> --}}
                               {{-- <input type="hidden" id="defultInventoryStatus" value="{{$productHold->inventory->current_status}}"> --}}
                            </a>
                        </p>

                        <p>
                            <div class="row ">
                                <div class="col-md-6 col-lg-6">
                                    <p class="font-weight-bold"> Product Hold-Unhold: </p>
                                </div>
                                <div class="">
                                            <div class="custom-switch custom-switch-primary mb-2">
                                                <input class="custom-switch-input" id="switch" type="checkbox" >
                                                <label class="custom-switch-btn" for="switch" data-active-text="jQuery"></label>
                                                {{-- <label class="custom-switch-btn" for="switch"></label> --}}
                                            </div>
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
<script src="{{ asset('assets/js/vendor/print.min.js') }}"></script>


{{-- <script>
    const ps = new PerfectScrollbar('#container', {
  wheelSpeed: 2,
  wheelPropagation: true,
  minScrollbarLength: 20
})
</script> --}}

   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

{{-- <script src="{{ asset('assets/CustomJS/Products/product-hold-show.js') }}"></script> --}}


@endsection
