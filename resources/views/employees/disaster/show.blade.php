@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Disaster' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', $employeeDisaster->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_disasters.employee_disaster.index') }}" class="btn btn-primary" title="Show All Employee Disaster">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_disasters.employee_disaster.create') }}" class="btn btn-success" title="Create New Employee Disaster">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_disasters.employee_disaster.edit', $employeeDisaster->id ) }}" class="btn btn-primary" title="Edit Employee Disaster">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Disaster" onclick="return confirm(&quot;Click Ok to delete Employee Disaster.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeDisaster->employee)->en_name }}</dd>
            <dt>Occured On</dt>
            <dd>{{ $employeeDisaster->occured_on }}</dd>
            <dt>Disaster Cause</dt>
            <dd>{{ optional($employeeDisaster->disasterCause)->name }}</dd>
            <dt>Disaster Severity</dt>
            <dd>{{ optional($employeeDisaster->disasterSeverity)->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $employeeDisaster->description }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeDisaster->attachment) }}</dd>
            <dt>Is Mass</dt>
            <dd>{{ ($employeeDisaster->is_mass) ? 'Yes' : 'No' }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeDisaster->status }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeDisaster->note }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeDisaster->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeDisaster->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeDisaster->approved_at }}</dd>

        </dl>

    </div>
</div>

@endsection