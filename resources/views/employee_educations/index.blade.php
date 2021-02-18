@extends('layouts.employee')
@section('pagetitle')
    Employee Educations
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Employee Educations</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Employee Educations List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($employeeEducations) == 0)
                <h4 class="text-center">No Employee Educations Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Level</th>
                            <th>Institute</th>
                            <th>Field</th>
                            <th>Gpa Scale</th>
                            <th>Gpa</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Has Coc</th>
                            <th>Coc Issued Date</th>
                            <th>Coc File</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Approved By</th>
                            <th>Approved At</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeEducations as $employeeEducation)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($employeeEducation->employee)->en_name }}</td>
                            <td>{{ optional($employeeEducation->educationLevel)->name }}</td>
                            <td>{{ optional($employeeEducation->educationalInstitute)->name }}</td>
                            <td>{{ optional($employeeEducation->educationalField)->name }}</td>
                            <td>{{ optional($employeeEducation->gpaScale)->name }}</td>
                            <td>{{ $employeeEducation->gpa }}</td>
                            <td>{{ $employeeEducation->start_date }}</td>
                            <td>{{ $employeeEducation->end_date }}</td>
                            <td>{{ ($employeeEducation->has_coc) ? 'Yes' : 'No' }}</td>
                            <td>{{ $employeeEducation->coc_issued_date }}</td>
                            <td>{{ $employeeEducation->coc_file }}</td>
                            <td>{{ $employeeEducation->status }}</td>
                            <td>{{ optional($employeeEducation->creator)->name }}</td>
                            <td>{{ optional($employeeEducation->approvedBy)->id }}</td>
                            <td>{{ $employeeEducation->approved_at }}</td>

                            <td>
                                <form method="POST" action="{!! route('employee_educations.employee_education.destroy', $employeeEducation->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employee_educations.employee_education.show', $employeeEducation->id ) }}" class="btn btn-primary" title="Show Employee Education">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employee_educations.employee_education.edit', $employeeEducation->id ) }}" class="btn btn-warning" title="Edit Employee Education">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee Education" onclick="return confirm(&quot;Click Ok to delete Employee Education.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $employeeEducations->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('employee_educations.employee_education.create') }}" class="btn btn-success" title="Create New Employee Education">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection