@extends('layouts.printer')
@section('pagetitle')
{{(__('employee.Study Trainings'))}}
@endsection
@section('content')
@permission('studyTrainings_print')
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
                        <td>{{ $employeeStudyTraining->has_commitment ? 'Yes' : 'No' }}
                            @if ($employeeStudyTraining->has_commitment == 1)
                                @if (isset($employeeStudyTraining->amount))
                                {{(__('employee.Br'))}}. {{ $employeeStudyTraining->amount }}
                                @endif
                                @if (isset($employeeStudyTraining->total_commitment))
                                    {{ $employeeStudyTraining->total_commitment }} {{(__('employee.Months'))}}
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @endpermission
@endsection
