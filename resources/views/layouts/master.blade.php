<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @include('layouts.head')
</head>

<body id="app-container" class="menu-default show-spinner">


     <!--*******************
        header start
    ********************-->
    @include('layouts.main-header' )
    <!--*******************
        header end
    ********************-->

     <!--*******************
        sidebar start
    ********************-->
    @include('layouts.side-menu')
    <!--*******************
        sidebar end
    ********************-->

    <!--*******************
        page header start
    ********************-->
     @yield('page-header')
    <!--*******************
        page header end
    ********************-->

    <!--*******************
        main start
    ********************-->
    @yield('content')

    <!--*******************
        main end
    ********************-->

    <!--*******************
        footer start
    ********************-->
    @include('layouts.footer')
    <!--*******************
        footer end
    ********************-->


    <!--*******************
        footer script start
    ********************-->
    @include('layouts.footer')
    <!--*******************
        footer script end
    ********************-->
    @include('layouts.footer-scripts')
</body>

</html>
