
{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : dec-19-2020 ************************}
{{-- **********************file-name: profile-show *********************** --}}
{{-- **********************  controller-name:  Users/Profile/ProfileController  *** --}}


@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}" />

    {{-- ***************** custom css *********************** --}}

    <link rel="stylesheet" href="{{ asset('assets/CustomCss/USers/Profile/profile-show.css') }}" />

@endsection

{{-- @section('page-header')


@endsection --}}


@section('content')


<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>{{ Auth::user()->first_name}} {{ Auth::user()->last_name }}</h1>
                    <div class="text-zero top-right-button-container">
                        <button type="button"
                            class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACTIONS
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
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
                <div class="separator mb-5"></div>

                </div>
                <div class="tab-content" style="margin-top: 100px;">
                    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                        <div class="row mt-7">
                            <div class="col-12 col-lg-5 col-xl-4 col-left">
                                <a href="{{ asset('assets/img/profile-pic.jpg') }}" class="lightbox">
                                    <img alt="Profile" src="{{ asset('assets/img/profile-pic-l.jpg') }}"
                                        class="img-thumbnail card-img social-profile-img">
                                </a>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="text-center pt-4">
                                            <p class="list-item-heading pt-2">{{ Auth::user()->first_name}} {{ Auth::user()->last_name }}</p>
                                        </div>
                                        <p class="mb-3">
                                            I’m a web developer. I spend my whole day, practically every day,
                                            experimenting with HTML, CSS, and JavaScript; dabbling with Python and
                                            Ruby; and inhaling a wide variety of potentially useless information
                                            through a few hundred RSS feeds. I build websites that delight and
                                            inform. I do it well.
                                        </p>

                                        <p class="text-muted text-small mb-2">Location</p>
                                        <p class="mb-3">{{ $employee->address }}</p>

                                        <p class="text-muted text-small mb-2">Responsibilities</p>
                                        <p class="mb-3">
                                            @foreach (Auth::user()->roles->pluck('name') as $role)
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">{{$role}}</span>
                                                </a>

                                            @endforeach

                                        </p>
                                        <p class="text-muted text-small mb-2">Contact</p>
                                        <div class="social-icons">
                                            <ul class="list-unstyled list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="simple-icon-social-facebook"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="simple-icon-social-twitter"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#"><i class="simple-icon-social-instagram"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-7 col-xl-8 col-right">
                                <div class="card mb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs " role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                                        aria-controls="first" aria-selected="true">User Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                                        aria-controls="second" aria-selected="false">Branch Info</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                                        aria-controls="third" aria-selected="false">Department Info</a>
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

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User Name </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->user->first_name }}  {{ $employee->user->last_name }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    {{-- ******************* user email  --}}

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User Email </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->user->email }} </p>
                                                                </div>
                                                                <p class="font-weight-medium mb-0 mt-3">  </p>

                                                            </div>

                                                        </div>

                                                    </div>
                                                        {{-- ****************** user contact --}}

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User Contact </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->user->contact }} </p>
                                                                </div>
                                                                <p class="font-weight-medium mb-0 mt-3">  </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    {{-- ******************** user cnic  --}}

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User CNIC </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->cnic }} </p>
                                                                </div>
                                                                <p class="font-weight-medium mb-0 mt-3">  </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                     {{-- ******************** user date of birth  --}}

                                                     <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User date of birth </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->date_of_birth }} </p>
                                                                </div>
                                                                <p class="font-weight-medium mb-0 mt-3">  </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-3  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> User Address </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->address }} </p>
                                                                </div>
                                                                <p class="font-weight-medium mb-0 mt-3">  </p>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    {{-- *************** id of enquiry ************ --}}
                                                   {{-- <input type="hidden" name="enquiryId" id="enquiryId" value="{{ $enquiry->id  }}"> --}}

                                                    <br />

                                                </div>
                                                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Branch Name </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->name }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Dealer Code </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->dealer_code }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Branch Contact </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->contact }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Branch Email </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->email }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Key Person1 contact </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->key_person1_contact }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Key Person2 contact </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->key_person2_contact }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Address </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-9">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->branch->address }} </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- ********************** third tab ********************* --}}
                                                <div class="tab-pane fade " id="third" role="tabpanel"
                                                    aria-labelledby="third-tab">

                                                    <div class="d-flex flex-row mb-2  justify-content-between">

                                                        <div class="pl-3 flex-grow-1 mt-2">

                                                            <div class="row">
                                                                <div class="col-md-3 col-lg-3">

                                                                    <p class="font-weight-medium mb-0 font-weight-bold"> Department Name </p>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                   <p class="font-weight-medium mb-0 "> {{ $employee->department->name }}  </p>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ****************** edit profile ***************** --}}

                                <div class="card mb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="pt-3"> Change Password </h5>
                                        </div>
                                        <div class="separator mb-5"></div>

                                        <div class="card-body" style="margin-top: -50px;">
                                            <p class="mb-3">

                                                    <a href="#" class="left" data-toggle="modal"
                                                    data-backdrop="static" data-target="#changePasswordModal">
                                                        <span
                                                            class="badge badge-pill  mb-1" style="padding-left:0px;font-size: 12px; color: #2a93d5;"> Change Password <i class="simple-icon-note pl-2" style="font-size: 13px;"></i> </span>
                                                    </a>

                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@include('Users.Profile.change-password-modal')

@endsection


{{-- ******************* all scripts file here ****************** --}}
@section('js')


<script src="{{ asset('assets/js/vendor/baguetteBox.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/notify.js') }}"></script>

   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

<script src="{{ asset('assets/CustomJS/Users/Profile/change-password-modal.js') }}"></script>


@endsection
