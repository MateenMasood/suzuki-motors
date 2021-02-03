@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-free/css/all.min.css')}}" />
<link rel="stylesheet" href="{{asset('assets/CustomCss/Branches/branch-list.css')}}" />

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
                <h1>Product Prices</h1>

                <div class="top-right-button-container">
                    <a type="button" href="{{url('products-prices/create')}}" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</a>
                    <div class="modal fade modal-right" id="rightModal" tabindex="-1" role="dialog"
                        aria-labelledby="rightModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rightModalLabel">Add New</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Submitting below form will add the data to Data Table and rows will be
                                        updated.</p>
                                    <form class="tooltip-right-top" id="addToDatatableForm" novalidate>
                                        <div class="form-group position-relative">
                                            <label>Name</label>
                                            <input type="text" name="Name" class="form-control">
                                        </div>
                                        <div class="form-group position-relative">
                                            <label>Sales</label>
                                            <input type="text" name="Sales" class="form-control">
                                        </div>
                                        <div class="form-group position-relative">
                                            <label>Stock</label>
                                            <input type="text" name="Stock" class="form-control">
                                        </div>
                                        <div class="form-group position-relative">
                                            <label>Category</label>
                                            <select class="form-control select2-single" name="Category" data-width="100%">
                                                <option></option>
                                                <option value="Cakes">Cakes</option>
                                                <option value="Cupcakes">Cupcakes</option>
                                                <option value="Desserts">Desserts</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-primary btn-multiple-state" id="addToDatatable">
                                        <div class="spinner d-inline-block">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                        <span class="icon success" data-toggle="tooltip" data-placement="top"
                                            title="Everything went right!">
                                            <i class="simple-icon-check"></i>
                                        </span>
                                        <span class="icon fail" data-toggle="tooltip" data-placement="top"
                                            title="Something went wrong!">
                                            <i class="simple-icon-exclamation"></i>
                                        </span>
                                        <span class="label">Done</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                            <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="checkAllDataTables">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </div>
                        <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split"
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
                            <a href="#">Products</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Products-Versions</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products-Versions-List</li>
                    </ol>
                </nav>
                <div class="mb-2">
                    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                        role="button" aria-expanded="true" aria-controls="displayOptions">
                        Display Options
                        <i class="simple-icon-arrow-down align-middle"></i>
                    </a>
                    <div class="collapse dont-collapse-sm" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <input class="form-control" placeholder="Search Table" id="searchDatatable">
                            </div>
                        </div>
                        <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                            <span class="text-muted text-small">Displaying 1-10 of 40 items </span>
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                10
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">5</a>
                                <a class="dropdown-item active" href="#">10</a>
                                <a class="dropdown-item" href="#">20</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separator"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
                <table id="tblProductsPrices" class="data-table responsive nowrap"
                    data-order="[[ 1, &quot;desc&quot; ]]">
                    <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Product</th>
                            <th>Version-Model</th>
                            <th>Invoice Price</th>
                            <th>Edit</th>
                            <th>Description</th>
                            {{-- <th class="empty">&nbsp;</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
<script src="{{asset('assets/CustomJs/Products/ProductsPrices/products-prices-list.js')}}"></script>
@endsection
