@extends('layouts.app')
@section('pagetitle')
    Employees
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">Organization Unit</a>
    </li>
    <li class="breadcrumb-item active">Employees</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee List</h3>
        </div>

        <div class="card-body">
            @if (count($employees) == 0)
                <h4 class="text-center">No Employees in this Units.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Sex</th>
                            <th>Organization Unit</th>
                            <th>Job Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->en_name }}</td>
                                <td>{{ $employee->sexes->name }}</td>
                                <td>{{ $employee->organizationUnitse->en_name }}</td>
                                <td>
                                    @foreach ($jobTitleCategories as $title)
                                        @if ($employee->jobPositions->job_title_category == $title->id)
                                            {{ $title->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('employees.employee.show', $employee->id) }}"
                                        class="btn btn-primary" title="Show Employee">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employees->render() !!}
            @endif
        </div>
    </div>

@endsection
