@extends('layouts.employee')
@section('pagetitle')
    Show Study Training
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_study_trainings.employee_study_training.index', $employee) }}">Study
            Training</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">Show Study Training</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('employee_study_trainings.employee_study_training.destroy', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employee_study_trainings.employee_study_training.edit', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) }}"
                            class="btn btn-warning" title="Edit Employee Study Training">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Employee Study Training"
                            onclick="return confirm(&quot;Click Ok to delete Employee Study Training.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-4">
                        <dt>Type</dt>
                        <dd>{{ $employeeStudyTraining->types->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Educational Institution</dt>
                        <dd>{{ $employeeStudyTraining->institutions->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Educational Level</dt>
                        <dd>{{ $employeeStudyTraining->levels->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Educational Field</dt>
                        <dd>{{ $employeeStudyTraining->fields->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>Duration</dt>
                        <dd>{{ $employeeStudyTraining->duration }}</dd>
                    </div>
                    @if (isset($employeeStudyTraining->start_date))
                        <div class="col-md-4">
                            <dt>Start Date</dt>
                            <dd>{{ $employeeStudyTraining->start_date }}</dd>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>Has Commitment</dt>
                        <dd>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}</dd>
                    </div>
                    @if (isset($employeeStudyTraining->total_commitment))
                        <div class="col-md-4">
                            <dt>Total Commitment(Months)</dt>
                            <dd>{{ $employeeStudyTraining->total_commitment }}</dd>
                        </div>
                    @endif
                    @if (isset($employeeStudyTraining->amount))
                        <div class="col-md-4">
                            <dt>Total Commitment(Amount)</dt>
                            <dd>{{ $employeeStudyTraining->amount }}</dd>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (isset($employeeStudyTraining->attachment))
                        <div class="col-md-4">
                            <dt>Attachment</dt>
                            <dd>
                                <a href="{{ asset('uploads/commitment/' . $employeeStudyTraining->attachment) }}"
                                    class="btn btn-primary mr-3" target="_blank">View File</a>
                            </dd>
                        </div>
                    @endif
                </div>
            </dl>
        </div>
    </div>

@endsection
