@extends('layouts.employee')
@section('pagetitle')
    Educations
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Educations</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Educations List</h3>
        </div>

        <div class="card-body">
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
                            <th>Status</th>
                            <th>Actions</th>
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
                                <td>
                                    @if ($employeeEducation->status == 1)
                                        Pending
                                    @elseif($employeeEducation->status == 2)
                                        Rejected
                                    @else
                                        Approved
                                    @endif
                                </td>

                                <td>
                                    @if ($employeeEducation->status == 3)
                                        <form method="POST" action="{!! route('employee_educations.employee_education.destroy', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) !!}" accept-charset="UTF-8">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <div class="btn-group btn-group-xs pull-right" role="group">
                                                <a href="{{ route('employee_educations.employee_education.show', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                                    class="btn btn-primary" title="Show Education">
                                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ route('employee_educations.employee_education.edit', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                                    class="btn btn-warning" title="Edit Education">
                                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                                </a>

                                                <button type="submit" class="btn btn-danger" title="Delete Education"
                                                    onclick="return confirm(&quot;Click Ok to delete Education.&quot;)">
                                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <a href="{{ route('employee_educations.employee_education.show', ['employee' => $employeeEducation->employees->id, 'employeeEducation' => $employeeEducation->id]) }}"
                                            class="btn btn-primary" title="Show Education">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $employeeEducations->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('employee_educations.employee_education.create', $employee) }}" class="btn btn-success mr-2"
        title="Create New Employee Education">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
    @if (count($employeeEducations) > 0)
        <a href="#" class="btn btn-primary" title="Print Employee Education">
            <span class="fa fa-print" aria-hidden="true"> Print</span>
        </a>
    @endif
@endsection
