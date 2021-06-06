@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Study Trainings'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Study Trainings'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Study Training List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('studyTrainings_list')
            @if (count($employeeStudyTrainings) == 0)
                <h4 class="text-center">{{(__('employee.No Study Trainings Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Type'))}}</th>
                            <th>{{(__('employee.Institution'))}}</th>
                            <th>{{(__('setting.Level'))}}</th>
                            <th>{{(__('employee.Field'))}}</th>
                            <th>{{(__('employee.Has Commitment'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employeeStudyTrainings as $employeeStudyTraining)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employeeStudyTraining->types->name }}</td>
                                <td>{{ $employeeStudyTraining->institutions->name }}</td>
                                <td>{{ $employeeStudyTraining->levels->name }}</td>
                                <td>{{ $employeeStudyTraining->fields->name }}</td>
                                <td>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}</td>

                                <td>
                                    <form method="POST" action="{!! route('employee_study_trainings.employee_study_training.destroy', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('studyTrainings_show')
                                            <a href="{{ route('employee_study_trainings.employee_study_training.show', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) }}"
                                                class="btn btn-primary" title="Show Study Training">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('studyTrainings_edit')
                                            <a href="{{ route('employee_study_trainings.employee_study_training.edit', ['employee' => $employeeStudyTraining->employees->id, 'employeeStudyTraining' => $employeeStudyTraining->id]) }}"
                                                class="btn btn-warning" title="Edit Study Training">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('studyTrainings_delete')
                                            <button type="submit" class="btn btn-danger" title="Delete Study Training"
                                                onclick="return confirm(&quot;Click Ok to delete Study Training.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $employeeStudyTrainings->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('studyTrainings_addNew')
    <a href="{{ route('employee_study_trainings.employee_study_training.create', $employee) }}"
        class="btn btn-success mr-2" title="Create New Study Training">
        <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
    </a>
    @endpermission
    @if (count($employeeStudyTrainings) > 0)
    @permission('studyTrainings_print')
        <a href="{{ route('employee_study_trainings.employee_study_training.print', $employee) }}" class="btn btn-primary" title="Print Employee Study Training" target="_blank">
            <span class="fa fa-print" aria-hidden="true"> {{(__('employee.Print'))}}</span>
        </a>
        @endpermission
    @endif
@endsection
