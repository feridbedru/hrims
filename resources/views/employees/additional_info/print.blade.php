@extends('layouts.printer')
@section('pagetitle')
    {{ __('emplyee.Additional Infos') }}
@endsection
@section('content')
    @permission('additionalInfo_print')
        @if (count($employeeAdditionalInfos) == 0)
            <h4 class="text-center">{{ __('employee.No Additional Infos Available') }}.</h4>
        @else
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>{{ __('employee.Number') }}</th>
                        <th>{{ __('employee.Place Of Birth') }}</th>
                        <th>{{ __('employee.Other Phone Number') }}</th>
                        <th>{{ __('employee.Nationality') }}</th>
                        <th>{{ __('employee.Religions') }}</th>
                        <th>{{ __('employee.Blood Group') }}</th>
                        <th>{{ __('employee.Tin Number') }}</th>
                        <th>{{ __('employee.Pension') }}</th>
                        <th>{{ __('employee.MaritalStatus') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeAdditionalInfos as $employeeAdditionalInfo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employeeAdditionalInfo->place_of_birth }}</td>
                            <td>{{ $employeeAdditionalInfo->other_phone_number }}</td>
                            <td>{{ optional($employeeAdditionalInfo->nationality)->name }}</td>
                            <td>{{ optional($employeeAdditionalInfo->religion)->name }}</td>
                            <td>{{ $employeeAdditionalInfo->blood_group }}</td>
                            <td>{{ $employeeAdditionalInfo->tin_number }}</td>
                            <td>{{ $employeeAdditionalInfo->pension }}</td>
                            <td>{{ optional($employeeAdditionalInfo->maritalStatus)->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @endpermission
    @endsection
