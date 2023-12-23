<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->
        <title>Sistem Informasi Geografi</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="shortcut icon" href="{{asset('logo.png')}}" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="{{asset('metronic/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{asset('metronic/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('metronic/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easyprint@2.1.9/libs/leaflet.min.css"> -->
        <!--end::Global Stylesheets Bundle-->
        <link href="{{asset('metronic/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.draw/docs/examples/libs/leaflet.css" />
        <link href="{{asset('custom/font-awesome-6.4/fa-all.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('custom/bootsrap523/bootstrap.min.css')}}">
        <link href="{{asset('custom\toastr\toastr.scss')}}" rel="stylesheet" type="text/css" /><!-- custom  -->
        <script src="{{asset('custom/jquery-3.6.4.js')}}" ></script>
        <script src="{{ asset('js/app.js') }}" defer></script>  
        <!-- <script src="{{asset('custom/leaflet/leaflet-src.js')}}"></script> -->
        <link rel="stylesheet" href="{{asset('custom/leaflet194/leaflet.css')}}" />
        <link rel="stylesheet" href="{{asset('custom/leaflet-draw/css/leaflet.css')}}" />
        <link rel="stylesheet" href="{{asset('custom/leaflet-draw/css/leaflet.draw.css')}}" />
        <!-- <link rel="stylesheet" href="{{asset('custom/mapbox/mapbox-gl.css')}}" /> -->
        <script src="{{asset('custom/leaflet194/leaflet.js')}}"></script>
        <script src="{{asset('custom/leaflet-draw/js/leaflet.draw.js')}}"></script>
        <script src="{{asset('custom/leaflet-easyprint/bundle.js')}}"></script>
        <script src="{{asset('custom/leaflet/Path.Drag.min.js')}}"></script>
        <script src="https://iamtekson.github.io/leaflet-geojson-vt/libs/geojson-vt.js"></script>
        <script src="{{asset('custom/geojson-vt/leaflet-geojson-vt.js')}}"></script>
        <script src="{{asset('custom/domtoimage/dom-to-image.min.js')}}"></script>

     
        <style type="text/css">
            .my-label{
                background-color: transparent;
                border: transparent;
                color: white;
                box-shadow: none;

            }

            .color_transparent{
                color: transparent;
            }

            .color_white{
                color: white;
            }

            .color_black{
                color: black;
            }
            
        .div_detail{
            display: none;position: fixed;z-index: 99!important;
            /*margin-left: 20px;*/
            padding: 20px;
            justify-content: center;
            align-items: right;
            right: 7vh;
            bottom: 5vh;
            max-height: 35vh;
            min-width: 200px;
        }
            .text-tooltip{
                color:black
            }
            .text-blok{
                color:blue;
                font-weight: bold;
                font-size: 18pt
            }
            .div_detail_body{
                max-height: 25vh;
                overflow: auto;
                width: 100%;

            }

            .header_detail{
                display: flex;
                align-items: flex-end;
            }

            .top {
                margin-top: 10px;
                border-bottom: 1px solid gray
            }
            
            select {
                width: 100px !important;
            }
            
            textarea {
                height: 200px !important;
            }
            
            .img_view {
                width: 300px;
                height: 200px;
                float: right;
            }
            
            .hd {
                display: none;
            }
            /*=========================== search =================*/
            
            .search {
                width: 300px;
                height: 10px;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 50px;
                font-size: 16px;
                background-image: url('searchicon.png');
                background-position: 10px 10px;
                background-repeat: no-repeat;
                padding: 12px 20px 12px 40px;
                -webkit-transition: width 0.4s ease-in-out;
                transition: width 0.4s ease-in-out;
            }
            
            .search:focus {
                width: 300px
            }
            /*=========================== search =================*/
            /*=========================== modal side =================*/
            
            #mod_edits {}
            /*=========================== modal side =================*/
            
            h5 {
                font-size: 14px!important;
            }
            
            #btn_search {
                margin-top: 20px!important;
                border-radius: 50%;
                position: fixed;
                z-index: 99!important;
                margin-left: 10px;
                padding: 20px;
                justify-content: center
            }
            
            #div_save {
            position: fixed;z-index: 99!important;
            margin-left: 20px;
            padding: 20px;
            justify-content: center;
            align-items: right;
            bottom: 5vh
            }   

            #div_delete_nop {
            position: fixed;z-index: 99!important;
            margin-left: 20px;
            padding: 20px;
            justify-content: center;
            align-items: right;
            bottom: 5vh
            }
            #div_delete_blok {
            position: fixed;z-index: 99!important;
            margin-left: 20px;
            padding: 20px;
            justify-content: center;
            align-items: right;
            bottom: 5vh
            }

            #div_delete_bangunan {
            position: fixed;z-index: 99!important;
            margin-left: 20px;
            padding: 20px;
            justify-content: center;
            align-items: right;
            bottom: 5vh
            }

            
            .select_wilayah {
                width: 200px!important
            }
            
        
            
            .ml-30 {
                margin-left: 30px;
            }
            /*
            .leaflet-control-zoom{
                margin-right: 50px!important;
                margin-bottom: 35px!important;
            }*/
            
            .leaflet-control-layers-overlays {
                display: none;
            }
            
            .li-informasi {
                color: black;
                margin-left: 30px;
                text-decoration: none;
            }
            
            table {
                display: block;
                height: 200px;
                overflow-y: scroll;
            }
            
            #img-logo {
                height: 30px
            }
            
            .div_image {
                text-align: center;
            }
            
            .menu-item a {
                text-decoration: none !important
            }
            
            .hd1 {
                display: none!important;
            }

            .divBtnTematik{
                /* background-color: white; */
            }
            .outer {
                display: flex; /* Use Flexbox for centering */
                justify-content: center; /* Horizontally center content */
                align-items: center; /* Vertically center content */
                width: 10wh; /* Make it full width */
                height: 10vh; /* Make it full height */
            }

            /* Inner div to be centered */
            .inner {
                width: 200px; /* Set a fixed width for the inner div */
                height: 100px; /* Set a fixed height for the inner div */
                background-color: transparent; /* Background color for demonstration */
                text-align: center; /* Optional: Center text horizontally */
                line-height: 100px; /* Optional: Center text vertically */
            }

            #breadcumb{
                margin-left: 10px;
                margin-top: 20px;
                font-size: 20px;
                text-transform: uppercase;
            }
            #breadcumb_desa{
                margin-left: 10px;
                margin-top: 20px;
                font-size: 20px;
                text-transform: uppercase;
            }
        
            .form-control.form-control-solid{
                background-color: white;
            }
            #kt_header{
                /* height: 30px; */
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6.5.0/turf.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
        
        @include('layouts.sidebar.sidebar')
        @stack('modals')
        
        @livewireScripts
        @stack('scripts')
    </body>
    
    
    @include('layouts.global')
    @include('tes.footer')
</html>


