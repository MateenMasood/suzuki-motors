@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
<link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " />
<link rel="stylesheet" href="{{asset('assets/CustomCss/Branches/branch-create.css')}}" />
<link rel="stylesheet" href="{{asset('assets/CustomCss/order-create.css')}}" />
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

                <h1>Create Order</h1>
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
                        <h5 class="mb-4">Order Info</h5>
                        <form id="formAddOrder">
                            <!-- ******* Order Info ******* -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Enquiry #</label>
                                        <input type="text" class="form-control" id="enquiryNo" name="enquiryNo"  placeholder="Enquiry No" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Order Type</label>
                                        <select class="form-control" id="orderType" name="orderType" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Allocation">Allocation</option>
                                            <option value="Booking">Booking</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Customer Type</label>
                                        <select class="form-control" id="customerType" name="customerType" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Corporate">Corporate</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Customer Tax Status</label>
                                        <select class="form-control" id="customerTaxStatus" name="customerTaxStatus" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Filer">Filer</option>
                                            <option value="Non Filer">Non Filer</option>
                                            <option value="Exempt">Exempt</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea type="text" class="form-control" id="description" name="description" rows="2"  placeholder="Description"></textarea>
                                    </div>
                                </div>

                            </div>

                            <!-- ******* Invoicee Info  Container******* -->

                            <h5 class="mb-4" id="invoiceeType" style="display: none;">Invoicee Type</h5>

                            <div class="" id="invoiceeTypeContainer" style="display: none;">


                            </div>

                            <!-- ******* Customer Info ******* -->
                            <h5 class="mb-4">Customer Info</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Customer Name</label>
                                        <input type="text" class="form-control" id="customerName" name="customerName"  placeholder="Customer Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Customer Contact</label>
                                        <input type="text" class="form-control" id="customerContact" name="customerContact"  placeholder="Customer Contact">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Customer CNIC</label>
                                        <input type="text" class="form-control" id="customerCnic" name="customerCnic"  placeholder="Customer CNIC">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Invoice In  Name Of</label>
                                        <input type="text" class="form-control" id="invoiceInName" name="invoiceInName"  placeholder="Invoice In Name Of">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">CNIC Of Invoicee</label>
                                        <input type="text" class="form-control" id="cnicInvoicee" name="cnicInvoicee"  placeholder="CNIC Of Invoicee">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Contact Of Invoicee</label>
                                        <input type="text" class="form-control" id="contactInvoicee" name="contactInvoicee"  placeholder="Contact Of Invoicee">
                                    </div>
                                </div> --}}

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Customer Address</label>
                                        <textarea type="text" class="form-control" id="customerAddress" name="customerAddress" rows="2"  placeholder="Customer Address"></textarea>
                                    </div>
                                </div>

                            </div>


                             <!-- ******* Product Info ******* -->
                             <h5 class="mb-4">Product Info</h5>

                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product</label>
                                        <select class="form-control" id="product" name="product" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Version-Model</label>
                                        <select class="form-control" id="version" name="version" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Color</label>
                                        <select class="form-control colors"  name="color" id="color" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="red">Red</option>
                                            <option value="white">White</option>
                                            <option value="blue">Blue</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Inventory Item</label>
                                        <select class="form-control colors"  name="inventoryItem" id="inventoryItem" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="item 1">item 1</option>
                                            <option value="item 2">item 2</option>
                                            <option value="item 3">item 3</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Engine No</label>
                                        <input type="text" class="form-control engineNos" id="engineNo" name="engineNo"  placeholder="Engine No">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Chasis No</label>
                                        <input type="text" class="form-control chasisNos" id="chasisNo" name="chasisNo"  placeholder="Chasis No">
                                    </div>
                                </div>

                             </div>


                              <!-- ******* Product Prices ******* -->
                              <h5 class="mb-4">Product Prices</h5>

                              <div class="row">

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Basic Price</label>
                                         <input type="text" class="form-control " id="basicPrice" name="basicPrice"  placeholder="Basic Price" readonly>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Advance Tax</label>
                                         <input type="text" class="form-control " id="advanceTax" name="advanceTax"  placeholder="Advance Tax" readonly>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Total Price</label>
                                         <input type="text" class="form-control " id="totalPrice" name="totalPrice"  placeholder="Total Price" readonly>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Handeling Charges</label>
                                        <input type="text" class="form-control " id="handelingCharges" name="handelingCharges"  placeholder="Handeling Charges">
                                    </div>
                                </div>

                                 {{-- <div class="col-md-12 font-weight-bold">
                                    <p class="mb-3">Extended Warranty Programs</p>
                                 </div> --}}


                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Extended Warranty Plan</label>
                                         <select class="form-control colors"  name="extendedWarrantyPlan" id="extendedWarrantyPlan" data-width="100%">
                                             <option value="">Select</option>
                                             <option value="3rd & 4th year premium amount">3rd & 4th year premium amount</option>
                                         </select>
                                     </div>
                                 </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Warranty Price Plan</label>
                                        <select class="form-control" id="warrantyPricePlan" name="warrantyPricePlan" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Premium Oil">Premium Oil</option>
                                            <option value="Ultimate Oil">Ultimate Oil</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Warranty Price</label>
                                        <input type="text" class="form-control " id="warrantyPrice" name="warrantyPrice"  placeholder="Warranty Price" readonly>
                                    </div>
                                </div>

                                <!-- Hidden Input Field For Warranty Price Plan Id -->

                                <input type="hidden" id="warrantyPricePlanId" name="warrantyPricePlanId">

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Insurance Plan</label>
                                         <select class="form-control colors"  name="insurancePlan" id="insurancePlan" data-width="100%">
                                             <option value="">Select</option>
                                             <option value="3rd & 4th year premium amount">3rd & 4th year premium amount</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Insurance Price</label>
                                        <input type="text" class="form-control " id="insurancePrice" name="insurancePrice"  placeholder="Insurance Price" readonly>
                                    </div>
                                </div>

                                <!-- Hidden Input Field For Insurance Price  Id -->

                                <input type="hidden" id="insurancePriceId" name="insurancePriceId">

                                <div class="col-md-6">
                                    <div class="form-group row mb-1">
                                        <label class="col-12 col-form-label">Registration Required / Not Required</label>
                                        <div class="col-12">
                                            <div class="custom-switch custom-switch-primary-inverse mb-2">
                                                <input class="custom-switch-input" id="switchRegistrationFee"  type="checkbox">
                                                <label class="custom-switch-btn" for="switchRegistrationFee"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Registration Fee</label>
                                         <input type="text" class="form-control " id="registrationFee" name="registrationFee"  placeholder="Registration Fee" disabled readonly>
                                     </div>
                                 </div>

                                 <!-- Hidden Input Field For Registration Fee  Id -->

                                <input type="hidden" id="registrationFeeId" name="registrationFeeId">

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Jumbo Pack</label>
                                         <input type="text" class="form-control " id="jumboPack" name="jumboPack"  placeholder="Jumbo Pack">
                                     </div>
                                 </div>

                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Others</label>
                                         <input type="text" class="form-control " id="otherCharges" name="otherCharges"  placeholder="Others">
                                     </div>
                                 </div>


                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label for="name">Total Amount</label>
                                         <input type="text" class="form-control " id="totalAmount" name="totalAmount"  placeholder="Total Amount" readonly>
                                     </div>
                                 </div>

                              </div>

                              <!-- ******* Payment Info ******* -->
                              <h5 class="mb-4">Product Payment</h5>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Payment Type</label>
                                        <select class="form-control" id="paymentType" name="paymentType" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Demand Draft">Demand Draft</option>
                                            <option value="Check">Check</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Payment Amount</label>
                                        <input type="text" class="form-control" id="paymentAmount" name="paymentAmount"  placeholder="Invoice PricePayment Amount">
                                    </div>
                                </div>

                            </div>

                            <!-- ******* order docs   ******* -->
                            <h5 class="mb-4">Upload Docs</h5>
                            <div id="docs">

                            </div>
                            <div class="row mb-3">

                                 <div class="col-md-12 mb-3">
                                    <label>Upload docs</label>
                                     <div class="dropzone"> </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mb-0">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script src="{{asset('assets/js/vendor/jquery.validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/jquery.validate/additional-methods.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/notify.js')}}"></script>
<script src="{{asset('assets/CustomJs/Orders/order-create.js')}}"></script>
<script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
<script src="{{asset('assets/CustomJs/Orders/order-uploads-docs.js') }}"></script>
<script src="{{asset('assets/CustomJs/Orders/order-add.js')}}"></script>
<script src="{{asset('assets/CustomJs/Orders/add-invoicee-info.js')}}"></script>
@endsection
