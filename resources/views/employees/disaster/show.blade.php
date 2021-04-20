@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Disaster'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disasters.employee_disaster.index', $employee) }}">{{(__('employee.Disaster'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">    {{(__('employee.View Disaster'))}}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employee_disasters.employee_disaster.edit', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}"
                            class="btn btn-warning" title="Edit Employee Disaster">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Employee Disaster"
                            onclick="return confirm(&quot;Click Ok to delete Employee Disaster.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>{{(__('employee.Occured On'))}}</dt>
                <dd>{{ $employeeDisaster->occured_on }}</dd>
                <dt>{{(__('employee.Disaster Cause'))}}</dt>
                <dd>{{ $employeeDisaster->causes->name }}</dd>
                <dt>{{(__('employee.Disaster Severity'))}}</dt>
                <dd>{{ $employeeDisaster->severities->name }}</dd>
                <dt>{{(__('setting.Description'))}}</dt>
                <dd>{{ $employeeDisaster->description }}</dd>
                <dt>{{(__('employee.Is Mass'))}}</dt>
                <dd>{{ $employeeDisaster->is_mass ? 'Yes' : 'No' }}</dd>
                <dt>{{(__('employee.Status'))}}</dt>
                <dd>{{ $employeeDisaster->status }}</dd>
                <dt>{{(__('employee.Attachment'))}}</dt>
                <dd><a href="{{ asset('uploads/disaster/' . $employeeDisaster->attachment) }}"
                    class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a></dd>
            </dl>
        </div>
    </div>

@endsection
