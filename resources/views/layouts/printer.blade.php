<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pagetitle') | HRMS</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}"> --}}
</head>

<body>
    @php
        $header = DB::table('organizations')
            ->whereNotNull('header')
            ->pluck('header')
            ->first();
    @endphp
    @if (is_null($header))
        <div class="d-flex">
            <div class="float-left">
                @php
                    $logo = DB::table('organizations')
                        ->whereNotNull('logo')
                        ->pluck('logo')
                        ->first();
                @endphp
                @if (is_null($logo))
                    <h2>No Logo</h2>
                @else
                    <img src="{{ asset('uploads/organization/' . $logo) }}" width="100%" alt="Logo" class="mt-2">
                @endif
            </div>
            <div class="float-right">
                @php
                    $organization = DB::table('organizations')->first();
                @endphp
                @if (is_null($organization))
                    <h2>No details</h2>
                @else
                    <div class="row">
                        <div class="col-xs-4">
                            <h4>{{ $organization->am_name }}</h4>
                        </div>
                        <div class="col-xs-4">
                            <h4>{{ $organization->en_name }}</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
    @else
        <img src="{{ asset('uploads/organization/' . $header) }}" width="100%" alt="header">
    @endif<br>

    <div class="ml-3 lead">
        {{ $employee->en_name }} &emsp; | &emsp;
        {{ $employee->am_name }} &emsp; | &emsp;
        {{ $employee->sexes->name }} &emsp; | &emsp;
        {{ $employee->organizationUnitse->en_name }}
    </div><br>

    <h2 class="text-center">@yield('pagetitle')</h2>
    @yield('content')
    <br>
    @php
        $organization = DB::table('organizations')->first();
    @endphp
    @if (is_null($organization->footer))
        <table class="table fixed-bottom table-borderless">
            <tbody>
                <tr>
                    <td><i class="fa fa-phone-alt"></i> {{ $organization->phone_number }}</td>
                    <td><i class="fa fa-envelope-open"></i> {{ $organization->po_box }}</td>
                    <td><i class="fa fa-globe"></i> {{ $organization->website }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-fax"></i> {{ $organization->fax_number }}</td>
                    <td><i class="fa fa-at"></i> {{ $organization->email }}</td>
                    <td><i class="fa fa-location-arrow"></i> {{ $organization->address }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <img src="{{ asset('uploads/organization/' . $footer) }}" width="100%" alt="footer">
    @endif
</body>

</html>
