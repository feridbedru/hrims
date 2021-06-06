@extends('layouts.printer')
@section('pagetitle')
    {{ __('employee.Certifications') }}
@endsection
@section('content')
@permission('certifications_print')
    @if (count($employeeCertifications) == 0)
        <h4 class="text-center">{{ __('setting.No Certifications Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('setting.Name') }}</th>
                    <th>{{ __('employee.Issued On') }}</th>
                    <th>{{ __('employee.Skill Category') }}</th>
                    <th>{{ __('setting.CertificationVendors') }}</th>
                    <th>{{ __('employee.Link') }}</th>
                    <th>{{ __('employee.Expires On') }}</th>
                    <th>{{ __('employee.Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeCertifications as $employeeCertification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeCertification->name }}</td>
                        <td>{{ $employeeCertification->issued_on }}</td>
                        <td>{{ $employeeCertification->categories->name }}</td>
                        <td>{{ optional($employeeCertification->vendors)->name }}</td>
                        <td>{{ $employeeCertification->verification_link }}</td>
                        <td>{{ $employeeCertification->expires_on }}</td>
                        <td>
                            @if ($employeeCertification->status == 1)
                                {{ __('employee.Pending') }}
                            @elseif($employeeCertification->status == 2)
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
