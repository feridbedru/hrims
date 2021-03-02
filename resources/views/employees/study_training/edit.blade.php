@extends('layouts.employee')
@section('pagetitle')
    Edit Employee Study Training
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_study_trainings.employee_study_training.index') }}">Employee Study Training</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Employee Study Training</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_study_trainings.employee_study_training.update', $employeeStudyTraining->id) }}" id="edit_employee_study_training_form" name="edit_employee_study_training_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('employees.study_training.form', [
                                        'employeeStudyTraining' => $employeeStudyTraining,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_study_trainings.employee_study_training.index') }}" class="btn btn-warning mr-5" title="Show All Employee Study Training">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection