@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Judiciary Punishments'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Judiciary Punishments'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Judiciary Punishments List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('judiciaryPunishments_list')
            @if (count($employeeJudiciaryPunishments) == 0)
                <h4 class="text-center">{{(__('employee.No Judiciary Punishments Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('employee.Court Name'))}}</th>
                            <th>{{(__('employee.Reason'))}}</th>
                            <th>{{(__('employee.Punishment Type'))}}</th>
                            <th>{{(__('employee.Start Date'))}}</th>
                            <th>{{(__('employee.End Date'))}}</th>
                            <th>{{(__('employee.File'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('employee.Actions'))}}</th>
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
                                    @permission('judiciaryPunishments_show')
                                    <a href="{{ asset('uploads/punishment/' . $employeeJudiciaryPunishment->file) }}"
                                    class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                    @endpermission
                                </td>
                                <td>
                                    @if ($employeeJudiciaryPunishment->status == 1)
                                    {{(__('setting.Active'))}}
                                    @else
                                    {{(__('setting.Closed'))}}
                                    @endif
                                </td>

                                <td>
                                    <form method="POST" action="{!! route('employee_judiciary_punishments.employee_judiciary_punishment.destroy', ['employee' => $employeeJudiciaryPunishment->employees->id, 'employeeJudiciaryPunishment' => $employeeJudiciaryPunishment->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('judiciaryPunishments_edit')
                                            <a href="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.edit', ['employee' => $employeeJudiciaryPunishment->employees->id, 'employeeJudiciaryPunishment' => $employeeJudiciaryPunishment->id]) }}"
                                                class="btn btn-warning" title="Edit Employee Judiciary Punishment">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('judiciaryPunishments_delete')
                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Employee Judiciary Punishment"
                                                onclick="return confirm(&quot;Click Ok to delete Judiciary Punishment.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeJudiciaryPunishments->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('judiciaryPunishments_addNew')
    <a href="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.create', $employee) }}"
        class="btn btn-success mr-2" title="Create New Judiciary Punishment">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeJudiciaryPunishments) > 0)
    @permission('judiciaryPunishments_print')
        <a href="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.print', $employee) }}" class="btn btn-primary" title="Print Employee Judiciary Punishment" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
