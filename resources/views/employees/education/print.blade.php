@extends('layouts.printer')
@section('pagetitle')
    Educations
@endsection
@section('content')
    @if (count($employeeEducations) == 0)
        <h4 class="text-center">No Educations Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Level</th>
                    <th>Institute</th>
                    <th>Field</th>
                    <th>GPA</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeEducations as $employeeEducation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeEducation->levels->name }}</td>
                        <td>{{ $employeeEducation->institutes->name }}</td>
                        <td>{{ $employeeEducation->fields->name }}</td>
                        <td>{{ $employeeEducation->gpa }} / {{ optional($employeeEducation->gpaScales)->name }}
                        </td>
                        <td>{{ $employeeEducation->start_date }}</td>
                        <td>{{ $employeeEducation->end_date }}</td>
                        <td>
                            @if ($employeeEducation->status == 1)
                                Pending
                            @elseif($employeeEducation->status == 2)
                                Rejected
                            @else
                                Approved
                            @endif
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
