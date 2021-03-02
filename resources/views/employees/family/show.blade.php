@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeFamily->name) ? $employeeFamily->name : 'Employee Family' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_families.employee_family.destroy', $employeeFamily->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_families.employee_family.index') }}" class="btn btn-primary" title="Show All Employee Family">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_families.employee_family.create') }}" class="btn btn-success" title="Create New Employee Family">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_families.employee_family.edit', $employeeFamily->id ) }}" class="btn btn-primary" title="Edit Employee Family">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Family" onclick="return confirm(&quot;Click Ok to delete Employee Family.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeFamily->employee)->title }}</dd>
            <dt>Name</dt>
            <dd>{{ $employeeFamily->name }}</dd>
            <dt>Sex</dt>
            <dd>{{ optional($employeeFamily->sex)->name }}</dd>
            <dt>Relationship</dt>
            <dd>{{ optional($employeeFamily->relationship)->name }}</dd>
            <dt>Date Of Birth</dt>
            <dd>{{ $employeeFamily->date_of_birth }}</dd>
            <dt>Photo</dt>
            <dd>{{ asset('storage/' . $employeeFamily->photo) }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $employeeFamily->file) }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeFamily->status }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeFamily->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeFamily->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeFamily->approved_at }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeFamily->note }}</dd>

        </dl>

    </div>
</div>

@endsection