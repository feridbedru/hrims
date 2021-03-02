@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Study Training' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_study_trainings.employee_study_training.destroy', $employeeStudyTraining->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_study_trainings.employee_study_training.index') }}" class="btn btn-primary" title="Show All Employee Study Training">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_study_trainings.employee_study_training.create') }}" class="btn btn-success" title="Create New Employee Study Training">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_study_trainings.employee_study_training.edit', $employeeStudyTraining->id ) }}" class="btn btn-primary" title="Edit Employee Study Training">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Study Training" onclick="return confirm(&quot;Click Ok to delete Employee Study Training.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeStudyTraining->employee)->title }}</dd>
            <dt>Type</dt>
            <dd>{{ optional($employeeStudyTraining->commitmentFor)->name }}</dd>
            <dt>Educational Institution</dt>
            <dd>{{ optional($employeeStudyTraining->educationalInstitution)->name }}</dd>
            <dt>Educational Level</dt>
            <dd>{{ optional($employeeStudyTraining->educationalLevel)->name }}</dd>
            <dt>Educational Field</dt>
            <dd>{{ optional($employeeStudyTraining->educationalField)->name }}</dd>
            <dt>Start Date</dt>
            <dd>{{ $employeeStudyTraining->start_date }}</dd>
            <dt>Duration</dt>
            <dd>{{ $employeeStudyTraining->duration }}</dd>
            <dt>Has Commitment</dt>
            <dd>{{ ($employeeStudyTraining->has_commitment) ? 'Yes' : 'No' }}</dd>
            <dt>Total Commitment</dt>
            <dd>{{ $employeeStudyTraining->total_commitment }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeStudyTraining->attachment) }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeStudyTraining->creator)->name }}</dd>

        </dl>

    </div>
</div>

@endsection