<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Higher Education Management Information System" name="description" />
    <meta content="NSIA Team" name="author" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HEMIS') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" />
    @stack('styles')
    <style>
        .ltr {
                direction: ltr;
                text-align: left;                
            }
        </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124746908-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-124746908-1');
        </script>
        
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <!-- this is used to start the counter  -->
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    



    <!-- <script src="{{ asset('js/highcharts.src.js') }}"></script>
    <script src="{{ asset('js/highcharts.exporting.js') }}"></script>
    <script src="{{ asset('js/highcharts.export-data.js') }}"></script> -->

</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-sidebar-fixed">
    <!-- BEGIN HEADER -->
    @include('layouts.header')
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse portlet">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                @include('layouts.sidebar')
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="padding-top:0px;">
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head portlet" style="padding-right:20px;">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>{{ $title ?? "" }} 
                            <small>{{ $description ?? "" }}</small>
                        </h1>
                    </div>
                    <!-- END PAGE TITLE -->
                 
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE BASE CONTENT -->
                @yield('content')
                <!-- END PAGE BASE CONTENT -->
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner ltr"> {{ date('Y') }} &copy; Ministry of Higher Education </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script>
        var BaseUrl = "{{ url('') }}"
        
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'ap2',
            forceTLS: true,
            encrypted: false
        });

        function doConfirm() {
            if (!confirm("آیا مایل به پیشروی هستید؟")) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
    <script src="{{ asset('js/all.js') }}" type="text/javascript"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="{{ asset('js/counterup.min.js') }}"></script>
    <script src="{{ asset('css/summernote/dist/summernote.js')}}"></script>
    <script>
 	    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 		$('#summernote').summernote({
 		    height: 200,  
 		    toolbar: [
 		    ['style', ['bold', 'italic', 'underline', 'clear']],
 		    ['font', ['strikethrough', 'superscript', 'subscript']],
 		    ['fontsize', ['fontsize']],
 		    ['color', ['color']],
 		    ['para', ['ul', 'ol', 'paragraph']],
 		    ['height', ['height']],
 		  ]
 		});
 	    });
 	  </script>

    <script>
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
    </script>
    <script src="{{ asset('js/notification.js') }}" type="text/javascript"></script>
    @stack('scripts')

</body>

</html>