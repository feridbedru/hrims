@extends('layouts.printer')
@section('pagetitle')
    Families
@endsection
@section('content')
    @if (count($employeeFamilies) == 0)
        <h4 class="text-center">No Families Available.</h4>
    @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Relationship</th>
                    <th>Date Of Birth</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employeeFamilies as $employeeFamily)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employeeFamily->name }}</td>
                        <td>{{ $employeeFamily->sexes->name }}</td>
                        <td>{{ $employeeFamily->relationships->name }}</td>
                        <td>{{ $employeeFamily->date_of_birth }}</td>
                        <td>
                            @if ($employeeFamily->status == 1)
                                Pending
                            @elseif($employeeFamily->status == 2)
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
