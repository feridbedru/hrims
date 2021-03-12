@extends('layouts.employee')

@section('content')

<div class="card card-primary">
    <div class="card-header clearfix">

            <h4 class="card-title">{{ isset($title) ? $title : 'Employee Study Training' }}</h4>

        <div class="card-tools">

            <form method="POST" action="{!! route('employee_study_trainings.employee_study_training.destroy', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) !!}" accept-charset="UTF-8">
            @method('DELETE')
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">

                    <a href="{{ route('employee_study_trainings.employee_study_training.create',$employee) }}" class="btn btn-success" title="Create New Employee Study Training">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_study_trainings.employee_study_training.edit', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id] ) }}" class="btn btn-warning" title="Edit Employee Study Training">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Study Training" onclick="return confirm(&quot;Click Ok to delete Employee Study Training.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Type</dt>
            <dd>{{ $employeeStudyTraining->types->name }}</dd>
            <dt>Educational Institution</dt>
            <dd>{{ $employeeStudyTraining->institutions->name }}</dd>
            <dt>Educational Level</dt>
            <dd>{{ $employeeStudyTraining->levels->name }}</dd>
            <dt>Educational Field</dt>
            <dd>{{ $employeeStudyTraining->fields->name }}</dd>
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

        </dl>

    </div>
</div>

@endsection