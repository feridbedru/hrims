@extends('layouts.employee')
@section('pagetitle')
    Administrative Punishments
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Administrative Punishments</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Administrative Punishments List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
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
                            <th>File</th>
                            <th>Status</th>
                            <th>Actions</th>
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
                                    class="btn btn-primary mr-3" target="_blank">View File</a>
                                </td>
                                <td>
                                    @if ($employeeAdministrativePunishment->status == 1)
                                        Active
                                    @else
                                        Closed
                                    @endif
                                </td>

                                <td>
                                    <form method="POST" action="{!! route('employee_administrative_punishments.employee_administrative_punishment.destroy', ['employee' => $employeeAdministrativePunishment->employees->id, 'employeeAdministrativePunishment' => $employeeAdministrativePunishment->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.edit', ['employee' => $employeeAdministrativePunishment->employees->id, 'employeeAdministrativePunishment' => $employeeAdministrativePunishment->id]) }}"
                                                class="btn btn-warning" title="Edit Employee Administrative Punishment">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Administrative Punishment"
                                                onclick="return confirm(&quot;Click Ok to delete Administrative Punishment.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeAdministrativePunishments->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.create', $employee) }}"
        class="btn btn-success mr-2" title="Create New Administrative Punishment">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeAdministrativePunishments) > 0)
        <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.print', $employee) }}" class="btn btn-primary" title="Print Employee Administrative Punishment" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
