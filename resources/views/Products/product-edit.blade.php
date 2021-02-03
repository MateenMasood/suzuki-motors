{{-- ******************************************************************* --}}
{{-- ************ file created and written by mateen masood ************ --}}
{{-- **************** date : sep-26-2020 ************************}
{{-- **********************file-name: product-create *********************** --}}
{{-- **********************  controller-name:  Products/ProductController  *** --}}
<!-- Faque it, till you make it on 22/11/2020 -->
@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " />

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/product-edit.css') }} " />

@endsection



@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h1>Edit Product</h1>
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
                        <h5 class="mb-4">Edit Product Form</h5>

                        <form id="formCreate"  enctype="multipart/form-data" name="frmProduct">
                            {{ csrf_field() }}
                            {{-- @csrf --}}
                            {{-- **************** start row ******************* --}}
                            <div class="row">
                              <!--All selected images section -->
                              <div class="col-md-3 col-xl-2 col-lg-3 col-sm-6 mb-1 imgParent">
                                <div class="card dashboard-search d-flex justify-content-end img" style="background: url(https://wallpapercave.com/wp/wp2513988.jpg)">
                                  <div class="glyph-icon simple-icon-trash align-self-center bin" onclick="removeImage(this)"></div>
                                </div>
                              </div>
                            </div>
                          <div class="row">
                            <!-- End of all selected images section -->
                                {{-- *************** product name  ********** --}}
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="name">Name </label>
                                        <input type="text" class="form-control" id="name"
                                            name="name" value="{{$productInfo->name}}" required>

                                    </div>
                                </div>

                                {{-- ************* company name  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="company"> Company </label>
                                            <select class="form-control select2-single" data-width="100%" id="company" name="company" required data-val="{{$productInfo->company}}">
                                                <option value="">Select</option>
                                               <option value="suzuki">Suzuki</option>

                                            </select>

                                    </div>
                                </div>
                            </div>
                            {{-- ******************************** end row *************** --}}

                            <div class="row">


                                {{-- ************* branch id  *************** --}}

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="branchId"> Branch </label>
                                            <select class="form-control select2-single" data-width="100%" id="branchId" name="branchId" required data-val="{{$productInfo->branch_id}}">
                                                <option value="">Select</option>
                                                <option value="1233412">Rawalpindi branch</option>
                                            </select>


                                    </div>
                                </div>


                            </div>

                            <div class="row mb-3">

                                {{-- *************** product description ****************** --}}

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" rows="5" required id="description" name="description" required>{{$productInfo->description}}</textarea>

                                    </div>
                                </div>

                                {{-- ***************** product image ******** --}}
                                <div class="col-md-6">
                                    <label>Base Image</label>
                                     <div class="dropzone"> </div>
                                </div>

                                {{-- ******************* image file name ********--}}
                                <input type="hidden" id="image" name="image" value="https://wallpapercave.com/wp/wp2513988.jpg">

                            </div>
                               <h5 class="mb-4">Versions</h5>
                               <input id="versionsTGInput" data-role="tagsinput" type="text" onchange="changeVersionOptions(this)">
                             <!--End of tags input-->
                           <div class="row" id="divVersionTemplate">
                                @php $srNo = 1; @endphp
                                @foreach($productInfo->productVersion as $version)
                                <div class="col-sm-8 clearfix mt-2 row">
                                    <div class="form-group col-5">
                                      <input type="hidden" name="variantIds[]" id="variant_{{$version->id}}" value="{{$version->id}}">
                                      <input type="text" class="form-control model versionFields" name="model[]"
                                        placeholder="Model" data-provide="typeahead"
                                        autocomplete="off" value="{{$version->model}}">
                                      <span class="error-label error"></span>
                                    </div>
                                    <div class="form-group col-5">
                                      <select type="text" class="form-control version versionFields" name="version[]" data-val="{{$version->variant_label}}"
                                        placeholder="Label" data-provide="typeahead">
                                      </select>
                                      <span class="error-label error"></span>
                                    </div>
                                   <div class="input-group-append ">
                                          <button type="button" class="btn btn-primary default rowRemoveAction " data-id="{{$version->id}}" style="background:indianred;" >
                                              <i class="iconsminds-remove"></i>
                                          </button>
                                   </div>
                                 </div>
                                 @endforeach
                                 <div class="col-sm-8 clearfix mt-2 row">
                                       <div class="form-group col-5">
                                         <input type="text" class="form-control model versionFields" name="model[]"
                                           placeholder="Model" data-provide="typeahead"
                                           autocomplete="off">
                                         <span class="error-label error"></span>
                                       </div>
                                       <div class="form-group col-5">
                                         <select type="text" class="form-control version versionFields" name="version[]"
                                           placeholder="Label" data-provide="typeahead">
                                         </select>
                                         <span class="error-label error"></span>
                                       </div>
                                      <div class="input-group-append ">
                                             <button type="button" class="btn btn-primary default rowAction" >
                                                 <i class="iconsminds-add"></i>
                                             </button>
                                      </div>
                                 </div>


                                 <input type="hidden" id="versionOptionsInput" data-options="{{json_encode($productInfo->productVersion)}}">
                           </div>

                            <button type="submit" id="submit" class="btn btn-primary mb-0 mt-4">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


{{-- ******************* all scripts file here ****************** --}}
@section('js')

    <script src="{{ asset('assets/js/vendor/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/notify.js') }}"></script>


   {{-- *********************** custom js files ****************** --}}
   {{-- *********************** addded by mateen masood ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

    <script src="{{ asset('assets/CustomJs/Products/product-edit.js') }}"></script>




@endsection
