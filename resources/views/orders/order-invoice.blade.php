@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-free/css/all.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/CustomCss/Branches/branch-list.css')}}" />
<style>

    .col-print-1 {width:8.33%;  float:left;}
    .col-print-2 {width:16.66%; float:left;}
    .col-print-3 {width:25%; float:left;}
    .col-print-4 {width:33.3333%; float:left;}
    .col-print-5 {width:41.9%; float:left;}
    .col-print-6 {width:50%; float:left;}
    .col-print-7 {width:58%; float:left;}
    .col-print-8 {width:66%; float:left;}
    .col-print-9 {width:75%; float:left;}
    .col-print-10{width:83%; float:left;}
    .col-print-11{width:92%; float:left;}
    .col-print-12{width:100%; float:left;}

    .border-2 {
    border-width:2px;
    border-style: solid;
    }

</style>
@endsection

{{-- @section('page-header')

<div class="col-12">
    <h1>Dashboard</h1>
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
        <ol class="breadcrumb pt-0">
            <li class="breadcrumb-item">
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Branches</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Branches-List</li>
        </ol>
    </nav>
    <div class="separator mb-5"></div>
</div>

@endsection --}}

@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Invoice</h1>
                <div class="top-right-button-container">
                    <button type="button" id="btnPrintInvoice" class="btn btn-primary" href="#"><div class="glyph-icon simple-icon-printer d-inline mr-1"></div>Print Invoice</button>
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
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-body" id="invoicePrint">

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-4">
                                <img src="https://coloredstrategies.com/mailing/dore.png" />
                            </div>
                            <div class="col-print-8 text-right">
                               <p class="p-0 m-1 font-weight-bold"> {{Auth::user()->employee->branch->name}}</p>
                                <p class="p-0 m-1 font-weight-bold">{{Auth::user()->employee->branch->contact.'-'.Auth::user()->employee->branch->key_person1_contact}}</p>
                            </div>
                        </div>

                        <div class="col-print-12 row mb-2">
                            <h5 class="font-weight-bold">Order Info</h5>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Enquiry Id</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->enquiry()->exists()? $order->order_relation->enquiry->enquiry_id: '' }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Order Type</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_type }}</div>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer Type</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->customer_type }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer Tax Status</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->taxpayer_type }}</div>
                        </div>


                        <div class="col-print-12 row mb-2">
                            <h5 class="font-weight-bold">Customer Info</h5>
                        </div>

                        @if ($order->order_relation->customer()->exists())
                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer Name</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->customer->name }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer Contact</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->customer->contact }}</div>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer CNIC</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->customer->cnic }}</div>

                            {{-- <div class="col-print-2 font-weight-bold p-2 border-2">Customer Contact</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{$order->order_relation->customer->contact }}</div> --}}
                        </div>

                        <div class="col-print-12 row mb-3">

                            <div class="col-print-2 font-weight-bold p-2 border-2">Customer Address</div>
                            <div class="col-print-10 font-weight-bold p-2 border-2">{{$order->order_relation->customer->address }}</div>
                        </div>

                        @endif

                        <div class="col-print-12 row mb-2">
                            <h5 class="font-weight-bold">Invoicee Info</h5>
                        </div>

                        @if ($order->order_relation->dealer()->exists())

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Bank</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->dealer->bankBranches->bank->name }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Bank Branch</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->dealer->bankBranches->name }}</div>
                        </div>
                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Bank Agent</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->dealer->name }}</div>
                        </div>
                        @elseif ($order->order_relation->corporate()->exists())
                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Corporate</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_relation->corporate->name }}</div>
                        </div>
                        @else

                        @endif

                        <div class="col-print-12 row mb-2">
                            <h5 class="font-weight-bold">Product Info</h5>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Vehicle</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_item->inventory->productVersion->product->name }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Version-Model</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_item->inventory->productVersion->variant_label.'-'.$order->order_item->inventory->productVersion->model }}</div>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Color</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_item->inventory->color }}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Engine-No</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_item->inventory->engine_no }}</div>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Chasis-No</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->order_item->inventory->chassis_no }}</div>
                        </div>

                        <div class="col-print-12 row mb-2">
                            <h5 class="font-weight-bold">Product Prices</h5>
                        </div>
                        <div class="col-print-12 row mb-3">
                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Basic Price</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Invoice Price'] }}</div>

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Tax Amount</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Tax Amount'] }}</div>


                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Total Price</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Invoice Price']+$orderCharges['Tax Amount'] }}</div>
                                @if (Arr::exists($orderCharges,'Handeling Charges'))
                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Handeling Charges</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Handeling Charges'] }}</div>
                                @endif

                            @if ($order->order_relation->extended_warranty()->exists())

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Extended Warranty Plan</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $order->order_relation->extended_warranty->warranty_type }}</div>

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Warranty Price Plan</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $order->order_relation->extended_warranty->price_type }}</div>

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Warranty Price</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Warranty Price'] }}</div>

                            @endif

                            @if ($order->order_relation->insurance_program()->exists())
                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Insurance Plan</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $order->order_relation->insurance_program->insurance_type }}</div>

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Insurance Price</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Insurance Price'] }}</div>
                            @endif

                            @if ($order->order_relation->registration_fee()->exists())
                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Registration Fee</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Registration Fee'] }}</div>

                            @endif

                            @if (Arr::exists($orderCharges,'JumboPack Charges'))

                            <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Jumbo Pack</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['JumboPack Charges'] }}</div>
                            @endif

                                @if (Arr::exists($orderCharges,'Other Charges'))
                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Others</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Other Charges'] }}</div>
                                @endif

                                <div class="col-print-2 font-weight-bold p-2 border-2 mb-3">Total Amount</div>
                                <div class="col-print-4 font-weight-bold p-2 border-2 mb-3">{{ $orderCharges['Total Amount'] }}</div>

                    </div>

                        <div class="col-print-12  mb-2">
                            <h5 class="font-weight-bold">Payments</h5>
                        </div>


                        <div class="col-print-12 row">
                            <div class="col-print-4 font-weight-bold p-2 border-2">Payment Mode</div>

                            <div class="col-print-4 font-weight-bold p-2 border-2">Payment Amount</div>

                            <div class="col-print-4 font-weight-bold p-2 border-2">Total Amount</div>
                        </div>

                        @foreach ($order->payment as $payment)

                        <div class="col-print-12 row">
                        <div class="col-print-4 font-weight-bold p-2 border-2">{{$payment->payment_mode}}</div>

                        <div class="col-print-4 font-weight-bold p-2 border-2">{{$payment->amount}}</div>

                        <div class="col-print-4 font-weight-bold p-2 border-2">{{$payment->amount}}</div>
                        </div>

                        @endforeach

                        <div class="col-print-12 row mt-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Total Amount</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $orderCharges['Total Amount'] }}</div>
                        </div>
                        <div class="col-print-12 row">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Received Amount</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ $order->payment->sum('amount') }}</div>
                        </div>
                        <div class="col-print-12 row">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Balance Amount</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2">{{ ($orderCharges['Total Amount'])-($order->payment->sum('amount')) }}</div>
                        </div>

                        <div style='page-break-after:always'></div>

                        <div class="col-print-12 row mb-2 mt-3">
                            <h5 class="font-weight-bold">Comments</h5>
                        </div>
                        <div class="col-print-12 row mb-5" style="height: 70px;">
                            <div class="col-print-12 font-weight-bold p-2 border-2">
                            </div>
                        </div>

                        <div class="col-print-12 row mb-3">
                            <div class="col-print-2 font-weight-bold p-2 border-2">Sold By</div>
                        <div class="col-print-4 font-weight-bold p-2 border-2">{{$createdBy->first_name.' '.$createdBy->last_name}}</div>

                            <div class="col-print-2 font-weight-bold p-2 border-2">Finance Dept</div>
                            <div class="col-print-4 font-weight-bold p-2 border-2"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script   src="{{asset('assets/js/vendor/printThis/printThis.js')}}"></script>
<script>
    $('#btnPrintInvoice').click(function () {
        $('#invoicePrint').printThis({
            importCSS: true,            // import parent page css
            importStyle: true,
        });
    });
</script>
@endsection
