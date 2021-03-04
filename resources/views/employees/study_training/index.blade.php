@extends('layouts.employee')
@section('pagetitle')
    Study Trainings
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Study Trainings</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Study Trainings List</h3>
        </div>

        <div class="card-body">
            @if (count($employeeStudyTrainings) == 0)
                <h4 class="text-center">No Study Trainings Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Institution</th>
                            <th>Level</th>
                            <th>Field</th>
                            <th>Has Commitment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeStudyTrainings as $employeeStudyTraining)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeStudyTraining->en_name }}</td>
                                <td>{{ $employeeStudyTraining->type }}</td>
                                <td>{{ $employeeStudyTraining->institution }}</td>
                                <td>{{ $employeeStudyTraining->level }}</td>
                                <td>{{ $employeeStudyTraining->field }}</td>
                                <td>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_study_trainings.employee_study_training.destroy', $employeeStudyTraining->id) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('employee_study_trainings.employee_study_training.show', $employeeStudyTraining->id) }}"
                                                class="btn btn-primary" title="Show Study Training">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('employee_study_trainings.employee_study_training.edit', $employeeStudyTraining->id) }}"
                                                class="btn btn-warning" title="Edit Study Training">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn btn-danger" title="Delete Study Training"
                                                onclick="return confirm(&quot;Click Ok to delete Study Training.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeStudyTrainings->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_study_trainings.employee_study_training.create') }}" class="btn btn-success"
        title="Create New Study Training">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
