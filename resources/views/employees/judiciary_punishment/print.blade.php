@extends('layouts.printer')
@section('pagetitle')
    Judiciary Punishments
@endsection
@section('content')
    @if (count($employeeJudiciaryPunishments) == 0)
        <h4 class="text-center">No Judiciary Punishments Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Court Name</th>
                    <th>Reason</th>
                    <th>Punishment Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeJudiciaryPunishments as $employeeJudiciaryPunishment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeJudiciaryPunishment->court_name }}</td>
                        <td>{{ $employeeJudiciaryPunishment->reason }}</td>
                        <td>{{ $employeeJudiciaryPunishment->punishment_type }}</td>
                        <td>{{ $employeeJudiciaryPunishment->start_date }}</td>
                        <td>{{ $employeeJudiciaryPunishment->end_date }}</td>
                        <td>
                            @if ($employeeJudiciaryPunishment->status == 1)
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
