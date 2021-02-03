
{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : oct-31-2020 ************************}
{{-- **********************file-name: employees-list *********************** --}}
{{-- **********************  controller-name:  Users/EmployeeController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

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
                    <h1>Employees List</h1>

                    <div class="top-right-button-container">
                        <a href="{{ url('/users/create') }}">
                             <button type="button" class="btn btn-primary btn-lg top-right-button mr-1" >Add New Users</button>

                        </a>

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
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Library</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
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
                    <table id="tblEmployees" class="data-table responsive nowrap"
                        data-order="[[ 1, &quot;desc&quot; ]]">
                        <thead>
                            <tr>
                                <th>Sr# </th>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Contact</th>
                                <th>Department</th>
                                <th>Branch</th>
                                {{-- <th>enquiry_status</th> --}}
                                {{-- <th>Base Image</th> --}}
                                <th class="empty">&nbsp;</th>
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


{{-- ******************* all scripts file here ****************** --}}
@section('js')


   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

<script src="{{ asset('assets/CustomJS/Users/employees-list.js') }}"></script>


@endsection
