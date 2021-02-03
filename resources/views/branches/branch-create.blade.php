@extends('layouts.master')

@section('css')
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

                <h1>Create Branch</h1>
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
                        <form id="formAddBranch">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Branch Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"  placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Contact</label>
                                        <input type="text" class="form-control" id="contact" name="contact"  placeholder="Contact">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Dealer Code</label>
                                        <input type="text" class="form-control" id="dealerCode" name="dealerCode" placeholder="Dealer Code">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Key Contact Person 1</label>
                                        <input type="text" class="form-control" id="keyPerson1Contact" name="keyPerson1Contact" placeholder="Key Contact Person 1">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Key Contact Person 2</label>
                                        <input type="text" class="form-control" id="keyPerson2Contact" name="keyPerson2Contact" placeholder="Key Contact Person 2">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <textarea type="text" class="form-control" id="address" name="address" rows="2" required="" placeholder="Address"></textarea>
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
<script src="{{asset('assets/CustomJs/Branches/branch-create.js')}}"></script>
@endsection
