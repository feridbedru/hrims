@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Administrative Punishments'))}}
@endsection
@section('content')
    @permission('administrativePunishments_print')
    @if (count($employeeAdministrativePunishments) == 0)
        <h4 class="text-center">{{(_('employee.No Administrative Punishments Available'))}}.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>{{(__('employee.Organization Name'))}}</th>
                    <th>{{(__('employee.Reason'))}}</th>
                    <th>{{(__('employee.Decision'))}}</th>
                    <th>{{(__('employee.Start Date'))}}/th>
                    <th>{{(__('employee.End Date'))}}</th>
                    <th>{{(__('employee.File'))}}</th>
                    <th>{{(__('employee.Status'))}}</th>
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
                            {{(__('employee.Active'))}}
                            @else
                            {{(__('employee.Closed'))}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
