<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('code') | {{ __('setting.HRMS') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-minimal.css') }}">
    @yield('stylesheets')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    @yield('js')
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="content-wrapper">
        <nav class="navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bars mr-2"></i> {{ __('setting.title') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <form class="form-inline mr-3" id="language">
                    <div class="input-group input-group-sm">
                        <select onchange="location = this.value;" name="lang" id="lang" class="form-control ">
                            @if (Config::get('app.locale') == 'am')
                                <option hidden="true" value="{{ url('locale/am') }}">አማርኛ</option>
                            @else
                                <option hidden="true" value="{{ url('locale/en') }}">English</option>
                            @endif
                            <option value="{{ url('locale/am') }}">አማርኛ</option>
                            <option value="{{ url('locale/en') }}">English</option>
                        </select>
                    </div>
                </form>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>


        <div class="px-2">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">

                    </div>
                </div>
            </div>

            <section class="content pb-5">
                <div class="container-fluid text-center">
                    {{--  --}}
                    <div class="jumbotron">
                        <i class="fas fa-exclamation-triangle fa-9x text-danger mb-5"></i>
                        <h1 class="display-1">@yield('code')</h1>
                        <hr class="my-4">
                        <p class="display-3">@yield('message')</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer class="main-footer b-0">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="http://techin.gov.et">TECHIN<sup>2</sup></a></strong>
    </footer>


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
