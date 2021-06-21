@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Disasters'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Disasters'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Disasters List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('disasters_list')
            @if (count($employeeDisasters) == 0)
                <h4 class="text-center">{{(__('employee.No Disaster Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('employee.Occured On'))}}</th>
                            <th>{{(__('employee.Disaster Cause'))}}</th>
                            <th>{{(__('employee.Disaster Severity'))}}</th>
                            <th>{{(__('setting.Description'))}}</th>
                            <th>{{(__('employee.Status'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeDisasters as $employeeDisaster)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeDisaster->occured_on }}</td>
                                <td>{{ $employeeDisaster->causes->name }}</td>
                                <td>{{ $employeeDisaster->severities->name }}</td>
                                <td>{{ $employeeDisaster->description }}</td>
                                <td>{{ $employeeDisaster->status }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('disasters_show')
                                            <a href="{{ route('employee_disasters.employee_disaster.show', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                                class="btn btn-primary" title="Show Disaster">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('disasters_edit')
                                            <a href="{{ route('employee_disasters.employee_disaster.edit', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                                                class="btn btn-warning" title="Edit Disaster">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('disasters_delete')
                                            <button type="submit" class="btn btn-danger" title="Delete Disaster"
                                                onclick="return confirm(&quot;Click Ok to delete Disaster.&quot;)">
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
                {{ $employeeDisasters->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('disasters_addNew')
    <a href="{{ route('employee_disasters.employee_disaster.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Disaster">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeDisasters) > 0)
    @permission('disasters_print')
        <a href="{{ route('employee_disasters.employee_disaster.print', $employee) }}" class="btn btn-primary" title="Print Employee Disaster" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
