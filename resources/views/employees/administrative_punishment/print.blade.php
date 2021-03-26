@extends('layouts.printer')
@section('pagetitle')
    Administrative Punishments
@endsection
@section('content')
    @if (count($employeeAdministrativePunishments) == 0)
        <h4 class="text-center">No Administrative Punishments Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Organization Name</th>
                    <th>Reason</th>
                    <th>Decision</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeAdministrativePunishments as $employeeAdministrativePunishment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeAdministrativePunishment->organization_name }}</td>
                        <td>{{ $employeeAdministrativePunishment->reason }}</td>
                        <td>{{ $employeeAdministrativePunishment->decision }}</td>
                        <td>{{ $employeeAdministrativePunishment->start_date }}</td>
                        <td>{{ $employeeAdministrativePunishment->end_date }}</td>
                        <td>
                            @if ($employeeAdministrativePunishment->status == 1)
                                Active
                            @else
                                Closed
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
