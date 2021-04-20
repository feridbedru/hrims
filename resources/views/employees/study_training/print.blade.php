@extends('layouts.printer')
@section('pagetitle')
    Studies and Trainings
@endsection
@section('content')
    @if (count($employeeStudyTrainings) == 0)
        <h4 class="text-center">No Study Trainings Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Type</th>
                    <th>Institution</th>
                    <th>Level</th>
                    <th>Field</th>
                    <th>Has Commitment</th>
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
                                    Br. {{ $employeeStudyTraining->amount }}
                                @endif
                                @if (isset($employeeStudyTraining->total_commitment))
                                    {{ $employeeStudyTraining->total_commitment }} Months
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
