@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Administrative Punishments'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Administrative Punishments'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Administrative Punishments List'))}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @permission('administrativePunishments_list')
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
                            <th>{{(__('setting.Actions'))}}</th>
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
                                    <a href="{{ asset('uploads/punishment/' . $employeeAdministrativePunishment->file) }}"
                                    class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                                </td>
                                <td>
                                    @if ($employeeAdministrativePunishment->status == 1)
                                        {{(__('employee.Active'))}}
                                    @else
                                        {{(__('employee.Closed'))}}
                                    @endif
                                </td>

                                <td>
                                    <form method="POST" action="{!! route('employee_administrative_punishments.employee_administrative_punishment.destroy', ['employee' => $employeeAdministrativePunishment->employees->id, 'employeeAdministrativePunishment' => $employeeAdministrativePunishment->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('administrativePunishments_edit')
                                            <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.edit', ['employee' => $employeeAdministrativePunishment->employees->id, 'employeeAdministrativePunishment' => $employeeAdministrativePunishment->id]) }}"
                                                class="btn btn-warning" title="Edit Employee Administrative Punishment">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('administrativePunishments_delete')
                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Administrative Punishment"
                                                onclick="return confirm(&quot;Click Ok to delete Administrative Punishment.&quot;)">
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
                {{ $employeeAdministrativePunishments->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('administrativePunishments_AddNew')
    <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.create', $employee) }}"
        class="btn btn-success mr-2" title="Create New Administrative Punishment">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeAdministrativePunishments) > 0)
    @permission('administrativePunishments_print')
        <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.print', $employee) }}" class="btn btn-primary" title="Print Employee Administrative Punishment" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
    @endif
    @endpermission
@endsection
