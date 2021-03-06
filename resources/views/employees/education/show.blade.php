@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Education' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_educations.employee_education.destroy', $employeeEducation->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_educations.employee_education.index') }}" class="btn btn-primary" title="Show All Employee Education">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_educations.employee_education.create') }}" class="btn btn-success" title="Create New Employee Education">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_educations.employee_education.edit', $employeeEducation->id ) }}" class="btn btn-primary" title="Edit Employee Education">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Education" onclick="return confirm(&quot;Click Ok to delete Employee Education.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ $employeeEducation->employees->en_name }}</dd>
            <dt>Level</dt>
            <dd>{{ $employeeEducation->levels->name }}</dd>
            <dt>Institute</dt>
            <dd>{{ $employeeEducation->institutes->name }}</dd>
            <dt>Field</dt>
            <dd>{{ $employeeEducation->fields->name }}</dd>
            <dt>Gpa Scale</dt>
            <dd>{{ optional($employeeEducation->gpaScale)->name }}</dd>
            <dt>Gpa</dt>
            <dd>{{ $employeeEducation->gpa }}</dd>
            <dt>Start Date</dt>
            <dd>{{ $employeeEducation->start_date }}</dd>
            <dt>End Date</dt>
            <dd>{{ $employeeEducation->end_date }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $employeeEducation->file) }}</dd>
            <dt>Has Coc</dt>
            <dd>{{ ($employeeEducation->has_coc) ? 'Yes' : 'No' }}</dd>
            <dt>Coc Issued Date</dt>
            <dd>{{ $employeeEducation->coc_issued_date }}</dd>
            <dt>Coc File</dt>
            <dd>{{ asset('storage/' . $employeeEducation->coc_file) }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeEducation->status }}</dd>

        </dl>

    </div>
</div>

@endsection