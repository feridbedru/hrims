@extends('layouts.printer')
@section('pagetitle')
    {{ __('employee.Licenses') }}
@endsection
@section('content')
@permission('licenses_print')
    @if (count($employeeLicenses) == 0)
        <h4 class="text-center">{{ __('employee.No Licenses Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Title') }}</th>
                    <th>{{ __('employee.License Type') }}</th>
                    <th>{{ __('employee.Issuing Organization') }}</th>
                    <th>{{ __('employee.Issuing Expiry Date') }}</th>
                    <th>{{ __('employee.Issuing Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeLicenses as $employeeLicense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeLicense->title }}</td>
                        <td>{{ $employeeLicense->types->name }}</td>
                        <td>{{ $employeeLicense->issuing_organization }}</td>
                        <td>{{ $employeeLicense->expiry_date }}</td>
                        <td>
                            @if ($employeeLicense->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeLicense->status == 2)
                                {{ __('employee.Rejected') }}
                            @else
                                {{ __('employee.Approved') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
