{{-- ******************************************************************* --}}
{{-- ************ file created and written by Ahsan Aftab Malik ************ --}}
{{-- **************** date : oct-24-2020 ************************}
{{-- **********************file-name: product-show *********************** --}}
{{-- **********************  controller-name:  Products/ProductController  *** --}}
@extends('layouts.master')


{{-- ***************** all css file here are **************** --}}

@section('css')

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }} " />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/dropzone.min.css') }} " />

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/product-create.css') }} " />

@endsection



@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Product Details</h1>
                    <div class="top-right-button-container">
                        <a href="http://127.0.0.1:8000/products/{{$productInfo->id}}/edit">
                             <button type="button" class="btn btn-primary btn-lg top-right-button mr-1">Edit</button>
                        </a>
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
                                    <!--Start of slides -->
                                    <li class="glide__slide">
                                        <img alt="detail" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcS0vu9KtkY0WrO81E2vwsymfQitL1tKVVA35w&usqp=CAU{{0 && $productInfo->base_image}}"
                                            class="responsive border-0 border-radius img-fluid mb-3" />
                                    </li>
                                    <!-- End of slides -->
                                </ul>
                            </div>
                        </div>

                        <div class="glide thumbs">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                  <!--Small images  -->
                                    <li class="glide__slide">
                                        <img alt="thumb" src="{{$productInfo->base_image}}"
                                            class="responsive border-0 border-radius img-fluid" />
                                    </li>
                                    <!--End of images -->
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
                                    aria-controls="first" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                    aria-controls="second" aria-selected="false">Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                    aria-controls="third" aria-selected="false">Comments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!--Product details -->
                            <div class="tab-pane fade show active" id="first" role="tabpanel"
                                aria-labelledby="first-tab">

                                <h5 class="card-title">Product Details</h5>

                                <table class="table table-borderless">
                                    <tbody>
                                      <tr>
                                          <th >Name</th>
                                          <td>{{$productInfo->name}}</td>
                                          <th>Company</th>
                                          <td>{{$productInfo->company}}</td>
                                      </tr>
                                      <tr>
                                          <th >Branch</th>
                                          <td>Mark</td>
                                          <th>Status</th>
                                          <td>{!!$productInfo->status ? '<span style="color:green !important;text-decoration:underline;">Active</span>'
                                                                      :
                                                                      '<span class="color:red;text-decoration:underline;">In-active</span>'!!}</td>
                                      </tr>
                                    </tbody>
                                </table>
                                <br>
                                <p class="font-weight-bold" >
                                  Product Description
                                </p>
                                <p>
                                  {{$productInfo->description}}
                                </p>

                                <p class="font-weight-bold">Available variants</p>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Variant Label</th>
                                                <th scope="col">Model</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php $srNo = 1; @endphp
                                          @foreach($productInfo->productVersion as $version)
                                            <tr>
                                                <th scope="row">{{$srNo++}}</th>
                                                <td>{{$version->variant_label}}</td>
                                                <td>{{$version->model}}</td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                    </table>
                                <br />
                            </div>
                            <!--End of product details -->

                            <!--Start of inventory sectoion -->
                            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">



                                <div class="d-flex flex-row mb-3 justify-content-between">
                                    <a href="#">
                                        <img src="img/profile-pic-l-4.jpg" alt="Philip Nelms"
                                            class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                    </a>
                                    <div class="pl-3 flex-grow-1">
                                        <a href="#">
                                            <p class="font-weight-medium mb-0">Philip Nelms</p>
                                            <p class="text-muted mb-0 text-small">Two Days Ago</p>
                                        </a>
                                        <p class="mt-3">
                                            Quisque consectetur lectus eros, sed sodales libero ornare cursus. Etiam
                                            elementum ut dolor eget hendrerit. Suspendisse eu lacus eu eros lacinia
                                            feugiat sit amet non purus.
                                        </p>
                                    </div>
                                    <div class="comment-likes">
                                        <span class="post-icon"><a href="#"><span>11 Likes</span> <i
                                                    class="simple-icon-heart ml-2"></i></a></span>
                                    </div>
                                </div>



                            </div>
                            <!--End of inventory sections  -->

                            <!--Start of comment section -->
                            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                                <div id="accordion">
                                    <div>
                                        <button class="btn btn-link p-0 pb-2 font-weight-bold"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <p>Craft beer labore wes anderson cred nesciunt?</p>
                                        </button>

                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="pb-4">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin
                                                coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident.
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-link collapsed p-0 pb-2 font-weight-bold"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            <p>Labore wes anderson cred nesciunt sapiente ea proident?</p>
                                        </button>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="pb-4">
                                                3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin
                                                coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice
                                                lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                                aesthetic synth
                                                nesciunt
                                                you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-link collapsed p-0 pb-2 font-weight-bold"
                                            data-toggle="collapse" data-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <p>Sunt aliqua put a bird on it squid?</p>
                                        </button>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="pb-4">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod.Nihil anim keffiyeh helvetica, craft
                                                beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice
                                                lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                                aesthetic synth
                                                nesciunt
                                                you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-link collapsed p-0 pb-2 font-weight-bold"
                                            data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            <p>Nihil anim keffiyeh helvetica?</p>
                                        </button>
                                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                                            <div class="pb-4">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin
                                                coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher
                                                vice
                                                lomo.
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-link collapsed p-0 pb-2 font-weight-bold"
                                            data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            <p>High life accusamus terry richardson?</p>
                                        </button>
                                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                                            <div class="pb-4">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry
                                                richardson ad squid. 3 wolf moon officia aute,
                                                non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum
                                                eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin
                                                coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                beer
                                                labore
                                                wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                                butcher vice lomo.
                                                <br />
                                                <br />

                                                Sed volutpat mollis dui eget fringilla. Vestibulum blandit urna ut
                                                tellus lobortis tristique. Vestibulum ante ipsum primis in faucibus
                                                orci luctus et ultrices posuere cubilia Curae; Pellentesque quis
                                                cursus mauris.

                                            </div>
                                        </div>
                                        <div class="comment-contaiener">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Add a comment">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="button"><span
                                                            class="d-inline-block">Send</span> <i
                                                            class="simple-icon-arrow-right ml-2"></i></button>
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

            <div class="col-12 col-md-12 col-xl-4 col-right">
                <div class="card mb-4">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button">
                            <i class="simple-icon-refresh"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="post-icon mr-3 d-inline-block"><a href="#"><i
                                        class="simple-icon-heart mr-1"></i></a> <span>4
                                    Likes</span></div>
                            <div class="post-icon d-inline-block"><i class="simple-icon-bubble mr-1"></i> <span>1
                                    Comment</span></div>
                        </div>
                        <p class="mb-3">
                            Vivamus ultricies augue vitae commodo condimentum. Nullam faucibus eros eu mauris
                            feugiat, eget consectetur tortor tempus.
                            <br /><br />
                            Sed volutpat mollis dui eget fringilla.
                            Vestibulum blandit urna ut tellus lobortis tristique. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque quis cursus
                            mauris.
                            <br /><br />
                            Nulla non purus fermentum, pulvinar dui condimentum, malesuada nibh. Sed
                            viverra quam urna, at condimentum ante viverra non. Mauris posuere erat sapien, a
                            convallis libero lobortis sit amet. Suspendisse in orci tellus.
                        </p>
                        <p class="text-muted text-small mb-2">Tags</p>
                        <p class="mb-3">
                            <a href="#">
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">FRONTEND</span>
                            </a>
                            <a href="#">
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">JAVASCRIPT</span>
                            </a>
                            <a href="#">
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">SECURITY</span>
                            </a>
                            <a href="#">
                                <span class="badge badge-pill badge-outline-theme-2 mb-1">DESIGN</span>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="card mb-4 d-none d-lg-block">
                    <div class="card-body">
                        <h5 class="card-title"><span>Similar Projects</span><a
                                class="btn-link float-right text-small pt-1" href="#">View All</a>
                        </h5>
                        <div class="row social-image-row gallery">
                            <div class="col-6">
                                <a href="img/marble-cake.jpg">
                                    <img class="img-fluid border-radius" src="img/marble-cake-thumb.jpg" />
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="img/parkin.jpg">
                                    <img class="img-fluid border-radius" src="img/parkin-thumb.jpg" />
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="img/fruitcake.jpg">
                                    <img class="img-fluid border-radius" src="img/fruitcake-thumb.jpg" />
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="img/tea-loaf.jpg">
                                    <img class="img-fluid border-radius" src="img/tea-loaf-thumb.jpg" />
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="img/napoleonshat.jpg">
                                    <img class="img-fluid border-radius" src="img/napoleonshat-thumb.jpg" />
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="img/magdalena.jpg">
                                    <img class="img-fluid border-radius" src="img/magdalena-thumb.jpg" />
                                </a>
                            </div>
                        </div>
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
   {{-- *********************** addded by Ahsan Aftab Malik ******** --}}
   {{-- *********************** initilized datatables here ******* --}}

    <script src="{{ asset('assets/CustomJs/Products/product-show.js') }}"></script>




@endsection
