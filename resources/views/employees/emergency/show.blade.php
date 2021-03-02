@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeEmergency->name) ? $employeeEmergency->name : 'Employee Emergency' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_emergencies.employee_emergency.destroy', $employeeEmergency->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_emergencies.employee_emergency.index') }}" class="btn btn-primary" title="Show All Employee Emergency">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_emergencies.employee_emergency.create') }}" class="btn btn-success" title="Create New Employee Emergency">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_emergencies.employee_emergency.edit', $employeeEmergency->id ) }}" class="btn btn-primary" title="Edit Employee Emergency">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Emergency" onclick="return confirm(&quot;Click Ok to delete Employee Emergency.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeEmergency->employee)->en_name }}</dd>
            <dt>Name</dt>
            <dd>{{ $employeeEmergency->name }}</dd>
            <dt>Phone Number</dt>
            <dd>{{ $employeeEmergency->phone_number }}</dd>
            <dt>Relationship</dt>
            <dd>{{ optional($employeeEmergency->relationship)->name }}</dd>
            <dt>Address</dt>
            <dd>{{ $employeeEmergency->address }}</dd>
            <dt>House Number</dt>
            <dd>{{ $employeeEmergency->house_number }}</dd>
            <dt>Other Phone</dt>
            <dd>{{ $employeeEmergency->other_phone }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeEmergency->status }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeEmergency->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeEmergency->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeEmergency->approved_at }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeEmergency->note }}</dd>

        </dl>

    </div>
</div>

@endsection