@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
<link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-free/css/all.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/CustomCss/Inventories/inventory-create.css')}}" />
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

                <h1>Create Inventory</h1>
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
                        <h5 class="mb-4"></h5>
                        <form id="formAddInventory">
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
                                        <label for="name">Type</label>
                                        <select class="form-control" id="type" name="type" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="allocation">Allocation</option>
                                            {{-- <option value="Booking">Booking</option> --}}
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <br><br>

                            <div class="d-flex justify-content-end m-3">
                                <button type="button"  class="btn btn-primary mb-0 addInventoryItem">Add Inventory Item</button>

                            </div>
                            <div class="row">
                                <div class="col-12 items" id="accordion" >

                                    <div class="card d-flex mb-3 inventoryItemContainer">
                                        <div class="d-flex flex-grow-1 min-width-zero collapseHeader" data-toggle="collapse" data-target="#collapse1"
                                            aria-expanded="true" aria-controls="collapse1">
                                            <button type="button" class="card-body btn btn-empty list-item-heading text-left text-one">
                                                Inventory item <span class="inventoryNumber">1</span>
                                            </button>
                                            <span><i class="fas fa-times m-4 remove-inventory-item btnDeleteItems" id="btnDeleteItem1"></i></span>
                                        </div>
                                        <div id="collapse1" class="collapse show collapseContent" data-parent="#accordion">
                                            <div class="card-body accordion-content">
                                                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Color</label>
                                                        <select class="form-control colors" id="color1" name="colors[]" id="color1" data-width="100%">
                                                            <option value="">Select</option>
                                                            <option value="red">Red</option>
                                                            <option value="white">White</option>
                                                            <option value="blue">Blue</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Engine No</label>
                                                        <input type="text" class="form-control engineNos" id="engineNo1" name="engineNos[]"  placeholder="Engine No">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Chasis No</label>
                                                        <input type="text" class="form-control chasisNos" id="chasisNo1" name="chasisNos[]"  placeholder="Chasis No">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </div>

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
<script src="{{asset('assets/CustomJs/Inventories/inventory-create.js')}}"></script>
@endsection
