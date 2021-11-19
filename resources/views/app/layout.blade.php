<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ config('app.name', 'Storify') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/app/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app/stories.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css')}}">


   @yield('head')

</head>
<body>
    {{-- @yield('navbar') --}}

    <div id="page-top">
        <div id="wrapper">

            @yield('sidebar')
            {{--  @include('partials.sidebar')  --}}
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    @include('partials.header')
                    <!-- End of Topbar -->

                    {{-- THE BODY GOES IN HERE --}}

                    @yield('content')

                    {{-- THE BODY GOES IN HERE --}}


                </div>
            </div>
                <!-- Footer -->
            {{--  @include('partials.footer')  --}}
            <!-- End of Footer -->
        </div>
    </div>

    <script type="text/javascript">
        // $(document).ready(function() {
        // // $('.selectpicker').selectpicker();

        // } );
    </script>

{{--    <section class="bg-login" style="min-height: 100vh">--}}
{{--        <div>--}}
{{--            @yield('content')--}}
{{--            --}}{{-- @yield('top-section') --}}
{{--        </div>--}}
{{--    </section>--}}


    <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/dropify/js/dropify.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/select2/select2.min.js') }}" type="text/javascript" async></script>


  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('/assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('/assets/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('/assets/js/demo/chart-pie-demo.js') }}"></script>


  <!-- Responsive and datatable js -->
  <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
  {{-- <script src="{{ asset('/assets/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script> --}}

  <script type="text/javascript">
      $(document).ready(function() {
          $('#datatable').DataTable(),
          $('#datatable2').DataTable();
      } );
  </script>

@yield('script')
</body>
</html>
