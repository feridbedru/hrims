@extends('layouts.employee')
@section('pagetitle')
    View Disaster
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disasters.employee_disaster.index', $employee) }}">Disaster</a>
    </li>
    <li class="breadcrumb-item active">View</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ isset($title) ? $title : 'Employee Disaster' }}</h4>
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
                <dt>Occured On</dt>
                <dd>{{ $employeeDisaster->occured_on }}</dd>
                <dt>Disaster Cause</dt>
                <dd>{{ $employeeDisaster->causes->name }}</dd>
                <dt>Disaster Severity</dt>
                <dd>{{ $employeeDisaster->severities->name }}</dd>
                <dt>Description</dt>
                <dd>{{ $employeeDisaster->description }}</dd>
                <dt>Is Mass</dt>
                <dd>{{ $employeeDisaster->is_mass ? 'Yes' : 'No' }}</dd>
                <dt>Status</dt>
                <dd>{{ $employeeDisaster->status }}</dd>
                <dt>Attachment</dt>
                <dd><a href="{{ asset('uploads/disaster/' . $employeeDisaster->attachment) }}"
                    class="btn btn-primary mr-3" target="_blank">View File</a></dd>
            </dl>
        </div>
    </div>

@endsection
