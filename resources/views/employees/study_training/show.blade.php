@extends('layouts.employee')
@section('pagetitle')
{{(__('setting.Show Study Training'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_study_trainings.employee_study_training.index', $employee) }}">{{(__('employee.Study Training'))}}</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('setting.Show Study Training'))}}</h4>
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
                        <dt>{{(__('employee.Type'))}}</dt>
                        <dd>{{ $employeeStudyTraining->types->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Educational Institution'))}}</dt>
                        <dd>{{ $employeeStudyTraining->institutions->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Educational Level'))}}</dt>
                        <dd>{{ $employeeStudyTraining->levels->name }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Educational Field'))}}</dt>
                        <dd>{{ $employeeStudyTraining->fields->name }}</dd>
                    </div>
                    <div class="col-md-4">
                        <dt>{{(__('employee.Duration'))}}</dt>
                        <dd>{{ $employeeStudyTraining->duration }}</dd>
                    </div>
                    @if (isset($employeeStudyTraining->start_date))
                        <div class="col-md-4">
                            <dt>{{(__('employee.Start Date'))}}</dt>
                            <dd>{{ $employeeStudyTraining->start_date }}</dd>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <dt>{{(__('employee.Has Commitment'))}}</dt>
                        <dd>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}</dd>
                    </div>
                    @if (isset($employeeStudyTraining->total_commitment))
                        <div class="col-md-4">
                            <dt>{{(__('employee.Total Commitment(Month)'))}}</dt>
                            <dd>{{ $employeeStudyTraining->total_commitment }}</dd>
                        </div>
                    @endif
                    @if (isset($employeeStudyTraining->amount))
                        <div class="col-md-4">
                            <dt>{{(__('employee.Total Commitment(Amount)'))}}</dt>
                            <dd>{{ $employeeStudyTraining->amount }}</dd>
                        </div>
                    @endif
                </div>
                <div class="row">
                    @if (isset($employeeStudyTraining->attachment))
                        <div class="col-md-4">
                            <dt>{{(__('employee.Attachment'))}}</dt>
                            <dd>
                                <a href="{{ asset('uploads/commitment/' . $employeeStudyTraining->attachment) }}"
                                    class="btn btn-primary mr-3" target="_blank">{{(__('employee.View File'))}}</a>
                            </dd>
                        </div>
                    @endif
                </div>
            </dl>
        </div>
    </div>

@endsection
