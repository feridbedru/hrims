<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pagetitle') | HRMS</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-minimal.css') }}">
    @yield('stylesheet')
</head>

<body class="hold-transition sidebar-mini layout-fixed pace-primary">
    <div class="wrapper">
        @include('menu.mainnav')
        @include('menu.sidenav')
        <div class="content-wrapper px-3">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 d-inline-flex pt-2 pb-2">
                            <h1 class="m-0 text-dark mr-2">
                                @yield('pagetitle')
                            </h1>
                            {{-- @php
                            $route_name = \Request::route()->getName();
                            $help_id = DB::table('help_news')->where('topic_for', $route_name)->pluck('id')->first();
                            @endphp
                            @if (is_null($help_id))
                                <a href="#" class="btn disabled"><i class="fas fa-question-circle"></i></a>
                                @else
                                <a href="{{ url('help/show') }}/{{ $help_id }}" target="_blank"><i
                                        class="fas fa-question-circle"></i></a>
                            @endif --}}
                        </div>
                        <div class="col-sm-6 pt-3 pb-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (Session::has('success_message'))
                    <div class="alert alert-success">
                        <span class="fa fa-ok"></span>
                        {!! session('success_message') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
            @endif
            <div class="container-fluid">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <section class="content">
                <div class="container-fluid">

                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="http://techin.gov.et">TECHIN</a>.</strong> All rights
            reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace-progress/pace.min.js') }}"></script>
    <script>
        $('#language').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    location.reload();
                }
            })

        });
        $('#lang').change(function() {
            $('#language').submit();
        })

    </script>
    @yield('javascripts')
    </div>
</body>

</html>
