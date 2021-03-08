@extends('layouts.employee')

@section('content')

<div class="card card-primary">
    <div class="card-header clearfix">

            <h4 class="card-title">{{ isset($title) ? $title : 'Employee Experience' }}</h4>

        <div class="card-tools">

            <form method="POST" action="{!! route('employee_experiences.employee_experience.destroy', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) !!}" accept-charset="UTF-8">
                @method('DELETE')
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">

                    <a href="{{ route('employee_experiences.employee_experience.create', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}" class="btn btn-success" title="Create New Employee Experience">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_experiences.employee_experience.edit', ['employee' => $employeeExperience->employees->id, 'employeeExperience' => $employeeExperience->id]) }}" class="btn btn-warning" title="Edit Employee Experience">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Experience" onclick="return confirm(&quot;Click Ok to delete Employee Experience.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ $employeeExperience->employees->en_name }}</dd>
            <dt>Experience Type</dt>
            <dd>{{ $employeeExperience->types->name }}</dd>
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
            <dd>{{ $employeeExperience->leftReasons->name }}</dd>
            <dt>Start Date</dt>
            <dd>{{ $employeeExperience->start_date }}</dd>
            <dt>End Date</dt>
            <dd>{{ $employeeExperience->end_date }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeExperience->attachment) }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeExperience->status }}</dd>

        </dl>

    </div>
</div>

@endsection