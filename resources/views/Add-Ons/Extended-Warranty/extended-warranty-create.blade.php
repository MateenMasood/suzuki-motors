@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
<link rel="stylesheet" href="{{asset('assets/CustomCss/Branches/branch-create.css')}}" />
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

                <h1>Create Extended Warranty</h1>
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
                        <form id="formAddExtendedWarranty">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Branch</label>
                                        <select class="form-control" id="branch" name="branch" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product</label>
                                        <select class="form-control" id="product" name="product" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
{{--
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Version-</label>
                                        <select class="form-control" id="version" name="version" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Model</label>
                                        <select class="form-control" id="model" name="model" data-width="100%">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div> --}}


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
                                        <label for="name">Warranty Type</label>
                                        <select class="form-control" id="warrantyType" name="warrantyType" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="3rd & 4th year premium amount">3rd & 4th year premium amount</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Price Type</label>
                                        <select class="form-control" id="priceType" name="priceType" data-width="100%">
                                            <option value="">Select</option>
                                            <option value="Premium Oil">Premium Oil</option>
                                            <option value="Ultimate Oil">Ultimate Oil</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Price</label>
                                        <input type="text" class="form-control" id="price" name="price"  placeholder="Price">
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
<script src="{{asset('assets/CustomJs/Add-Ons/Extended-Warranty/extended-warranty-create.js')}}"></script>
@endsection
