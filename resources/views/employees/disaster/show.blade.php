@extends('layouts.employee')

@section('content')

<div class="card card-primary">
    <div class="card-header clearfix">

            <h4 class="card-title">{{ isset($title) ? $title : 'Employee Disaster' }}</h4>

        <div class="card-tools">

            <form method="POST" action="{!! route('employee_disasters.employee_disaster.destroy', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">

                    <a href="{{ route('employee_disasters.employee_disaster.create',$employee) }}" class="btn btn-success" title="Create New Employee Disaster">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_disasters.employee_disaster.edit', ['employee' => $employeeDisaster->employees->id, 'employeeDisaster' => $employeeDisaster->id]) }}" class="btn btn-warning" title="Edit Employee Disaster">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Disaster" onclick="return confirm(&quot;Click Ok to delete Employee Disaster.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeDisaster->employee)->en_name }}</dd>
            <dt>Occured On</dt>
            <dd>{{ $employeeDisaster->occured_on }}</dd>
            <dt>Disaster Cause</dt>
            <dd>{{ $employeeDisaster->causes->name }}</dd>
            <dt>Disaster Severity</dt>
            <dd>{{ $employeeDisaster->severities->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $employeeDisaster->description }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeDisaster->attachment) }}</dd>
            <dt>Is Mass</dt>
            <dd>{{ ($employeeDisaster->is_mass) ? 'Yes' : 'No' }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeDisaster->status }}</dd>

        </dl>

    </div>
</div>

@endsection