@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">


        <div class="pull-right">

            

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>English Name</dt>
            <dd>{{ $employee->en_name }}</dd>
            <dt>Amharic Name</dt>
            <dd>{{ $employee->am_name }}</dd>
            <dt>Title</dt>
            <dd>{{ optional($employee->title)->en_title }}</dd>
            <dt>Sex</dt>
            <dd>{{ optional($employee->sex)->name }}</dd>
            <dt>Date Of Birth</dt>
            <dd>{{ $employee->date_of_birth }}</dd>
            <dt>Photo</dt>
            <dd>{{ asset('storage/' . $employee->photo) }}</dd>
            <dt>Phone Number</dt>
            <dd>{{ $employee->phone_number }}</dd>
            <dt>Organization Unit</dt>
            <dd>{{ optional($employee->organizationUnit)->en_name }}</dd>
            <dt>Job Position</dt>
            {{-- <dd>{{ optional($employee->jobPosition) }}</dd> --}}
            <dt>Employment ID</dt>
            <dd>{{ $employee->employment_id }}</dd>
            <dt>Employee Status</dt>
            <dd>{{ optional($employee->employeeStatus)->name }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employee->creator)->name }}</dd>

        </dl>

    </div>

    <form method="POST" action="{!! route('employees.employee.destroy', $employee->id) !!}" accept-charset="UTF-8">
        <input name="_method" value="DELETE" type="hidden">
        {{ csrf_field() }}
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('employees.employee.index') }}" class="btn btn-primary" title="Show All Employee">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('employees.employee.create') }}" class="btn btn-success" title="Create New Employee">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
                
                <a href="{{ route('employees.employee.edit', $employee->id ) }}" class="btn btn-primary" title="Edit Employee">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>

                <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </div>
        </form>
</div>

@endsection