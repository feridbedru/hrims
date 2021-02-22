@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Experience' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_experiences.employee_experience.destroy', $employeeExperience->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_experiences.employee_experience.index') }}" class="btn btn-primary" title="Show All Employee Experience">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_experiences.employee_experience.create') }}" class="btn btn-success" title="Create New Employee Experience">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_experiences.employee_experience.edit', $employeeExperience->id ) }}" class="btn btn-primary" title="Edit Employee Experience">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Experience" onclick="return confirm(&quot;Click Ok to delete Employee Experience.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeExperience->employee)->en_name }}</dd>
            <dt>Experience Type</dt>
            <dd>{{ optional($employeeExperience->experienceType)->name }}</dd>
            <dt>Organization Name</dt>
            <dd>{{ $employeeExperience->organization_name }}</dd>
            <dt>Organization Address</dt>
            <dd>{{ $employeeExperience->organization_address }}</dd>
            <dt>Job Position</dt>
            <dd>{{ $employeeExperience->job_position }}</dd>
            <dt>Level</dt>
            <dd>{{ $employeeExperience->level }}</dd>
            <dt>Salary</dt>
            <dd>{{ $employeeExperience->salary }}</dd>
            <dt>Left Reason</dt>
            <dd>{{ optional($employeeExperience->leftReason)->name }}</dd>
            <dt>Start Date</dt>
            <dd>{{ $employeeExperience->start_date }}</dd>
            <dt>End Date</dt>
            <dd>{{ $employeeExperience->end_date }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeExperience->attachment) }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeExperience->status }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeExperience->note }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeExperience->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeExperience->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeExperience->approved_at }}</dd>

        </dl>

    </div>
</div>

@endsection