<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pagetitle') | Employee | HRMS</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-minimal.css') }}">
    @yield('stylesheets')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="{{ route('employees.employee.show',['employee'=>$employee->id])}}">
                        <i class="fas fa-bars mr-2"></i>
                        @if (isset($employee->en_name))
                            {{ $employee->en_name }} | Dashboard
                        @else
                            Employee | Dashboard
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-success mr-3" title="Make CV">
                        Make CV
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-primary mr-3" title="Print ID Card">
                        Print ID
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employees.employee.printall',['employee'=>$employee->id])}}" class="btn btn-warning mr-3" title="Print this employee data" target="_blank">
                        Print All Data
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('menu.empsidenav')
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
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('employees.employee.index') }}">Employee</a>
                                </li>
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

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/plugins/pace-progress/pace.min.js') }}"></script>
    
    @yield('javascripts')
    </div>
</body>
</html>
