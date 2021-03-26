@extends('layouts.printer')
@section('pagetitle')
    Additional Information
@endsection
@section('content')
    @if (count($employeeAdditionalInfos) == 0)
        <h4 class="text-center">No Additional Infos Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Place Of Birth</th>
                    <th>Other Phone Number</th>
                    <th>Nationality</th>
                    <th>Religion</th>
                    <th>Blood Group</th>
                    <th>Tin Number</th>
                    <th>Pension</th>
                    <th>Marital Status</th>
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
@endsection
