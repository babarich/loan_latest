<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Loan Management System') }}</title>
    <meta name="Description" content="Loan Management System">
    <meta name="Author" content="">

@include('components.header')
@vite(['resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
<!-- Loader -->
<div id="loader" >
    <img src="{{asset('assets/images/media/loader.svg')}}" alt="">
</div>
<!-- Loader -->
@include('components.head')
@include('components.sidebar')
<div class="page">
    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

                <main>
                    @yield('content')
                </main>


        </div>
    </div>
    <!-- End::app-content -->
</div>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                {{\Carbon\Carbon::now()->format('Y')}}   &copy; Made with <i class="bi bi-heart text-danger" style="color: red"></i>
                <a href="">Faith Solutions</a>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">

                </div>
            </div>
        </div>
    </div>
</footer>
@include('components.footer')
@yield('scripts')
<script>
    $(document).ready(function (){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif

   
    });
</script>
</body>

</html>
