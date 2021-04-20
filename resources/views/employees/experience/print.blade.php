@extends('layouts.printer')
@section('pagetitle')
    Experiences
@endsection
@section('content')
    @if (count($employeeExperiences) == 0)
        <h4 class="text-center">No Experiences Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>{{(__('setting.Number'))}}</th>
                    <th>Type</th>
                    <th>Organization Name</th>
                    <th>Job Position</th>
                    <th>Level</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Salary</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeExperiences as $employeeExperience)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeExperience->types->name }}</td>
                        <td>{{ $employeeExperience->organization_name }}</td>
                        <td>{{ $employeeExperience->job_position }}</td>
                        <td>{{ $employeeExperience->level }}</td>
                        <td>{{ $employeeExperience->start_date }}</td>
                        <td>{{ $employeeExperience->end_date }}</td>
                        <td>{{ $employeeExperience->salary }}</td>
                        <td>
                            @if ($employeeExperience->status == 1)
                                Pending
                            @elseif($employeeExperience->status == 2)
                                Rejected
                            @else
                                Approved
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
