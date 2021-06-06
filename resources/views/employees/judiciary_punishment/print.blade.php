@extends('layouts.printer')
@section('pagetitle')
    {{ __('employee.Judiciary Punishments') }}
@endsection
@section('content')
@permission('judiciaryPunishments_print')
    @if (count($employeeJudiciaryPunishments) == 0)
        <h4 class="text-center">{{ __('employee.No Judiciary Punishments Available') }}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{ __('setting.Number') }}</th>
                    <th>{{ __('employee.Court Name') }}</th>
                    <th>{{ __('employee.Reason') }}</th>
                    <th>{{ __('employee.Punishment Type') }}</th>
                    <th>{{ __('employee.Start Date') }}</th>
                    <th>{{ __('employee.End Date') }}</th>
                    <th>{{ __('employee.Status') }}</th>
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
                                {{ __('setting.Active') }}
                            @else
                                {{ __('setting.Closed') }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
