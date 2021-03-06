<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>@yield('pagetitle') | {{(__('setting.HRMS'))}}</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-minimal.css') }}">
    @yield('stylesheets')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    @yield('js')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('menu.mainnav')
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('menu.sidenav')
            </aside>
        <div class="content-wrapper px-3">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 d-inline-flex pt-2 pb-2">
                            <h1 class="m-0 text-dark mr-2">
                                @yield('pagetitle')
                            </h1>
                            @php
                                $route_name = \Request::route()->getName();
                                $help_id = DB::table('helps')
                                    ->where('topic_for', $route_name)
                                    ->pluck('id')
                                    ->first();
                            @endphp
                            @if (is_null($help_id))
                                <a href="#" class="btn disabled"><i class="fas fa-question-circle"></i></a>
                                <a href="{{ route('helps.help.create', ['topic_for' => $route_name]) }}"
                                    title="Create New Help">
                                    <span class="fa fa-plus-circle text-success align-middle pt-2"></span>
                                </a>
                            @else
                                <a href="{{ route('helps.help.show', $help_id) }}/?topic_for=s" target="_blank"><i
                                        class="fas fa-question-circle pt-2"></i></a>
                            @endif
                        </div>
                        <div class="col-sm-6 pt-3 pb-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">{{(__('setting.Home'))}}</a></li>
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

            <section class="content pb-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.0
              </div>
            <strong>Copyright &copy; {{ date('Y') }} <a href="http://techin.gov.et">TECHIN<sup>2</sup></a></strong>
        </footer>

    </div>

    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
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
</body>
</html>