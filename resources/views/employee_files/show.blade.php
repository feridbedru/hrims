@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeFile->title) ? $employeeFile->title : 'Employee File' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_files.employee_file.destroy', $employeeFile->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_files.employee_file.index') }}" class="btn btn-primary" title="Show All Employee File">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_files.employee_file.create') }}" class="btn btn-success" title="Create New Employee File">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_files.employee_file.edit', $employeeFile->id ) }}" class="btn btn-primary" title="Edit Employee File">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee File" onclick="return confirm(&quot;Click Ok to delete Employee File.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeFile->employee)->title }}</dd>
            <dt>Title</dt>
            <dd>{{ $employeeFile->title }}</dd>
            <dt>Description</dt>
            <dd>{{ $employeeFile->description }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeFile->attachment) }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeFile->creator)->name }}</dd>

        </dl>

    </div>
</div>

@endsection