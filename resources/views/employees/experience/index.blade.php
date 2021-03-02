@extends('layouts.employee')
@section('pagetitle')
    Employee Experiences
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Experiences</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Experiences List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($employeeExperiences) == 0)
                <h4 class="text-center">No Employee Experiences Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Organization Name</th>
                            <th>Job Position</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeExperiences as $employeeExperience)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($employeeExperience->employee)->en_name }}</td>
                            <td>{{ optional($employeeExperience->experienceType)->name }}</td>
                            <td>{{ $employeeExperience->organization_name }}</td>
                            <td>{{ $employeeExperience->job_position }}</td>
                            <td>{{ $employeeExperience->salary }}</td>
                            <td>{{ $employeeExperience->status }}</td>

                            <td>
                                <form method="POST" action="{!! route('employee_experiences.employee_experience.destroy', $employeeExperience->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employee_experiences.employee_experience.show', $employeeExperience->id ) }}" class="btn btn-primary" title="Show Employee Experience">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employee_experiences.employee_experience.edit', $employeeExperience->id ) }}" class="btn btn-warning" title="Edit Employee Experience">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee Experience" onclick="return confirm(&quot;Click Ok to delete Employee Experience.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $employeeExperiences->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('employee_experiences.employee_experience.create') }}" class="btn btn-success" title="Create New Employee Experience">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection