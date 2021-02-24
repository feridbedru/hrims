@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeLicense->title) ? $employeeLicense->title : 'Employee License' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_licenses.employee_license.destroy', $employeeLicense->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_licenses.employee_license.index') }}" class="btn btn-primary" title="Show All Employee License">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_licenses.employee_license.create') }}" class="btn btn-success" title="Create New Employee License">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_licenses.employee_license.edit', $employeeLicense->id ) }}" class="btn btn-primary" title="Edit Employee License">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee License" onclick="return confirm(&quot;Click Ok to delete Employee License.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeLicense->employee)->en_name }}</dd>
            <dt>Title</dt>
            <dd>{{ $employeeLicense->title }}</dd>
            <dt>License Type</dt>
            <dd>{{ optional($employeeLicense->licenseType)->name }}</dd>
            <dt>Issuing Organization</dt>
            <dd>{{ $employeeLicense->issuing_organization }}</dd>
            <dt>Expiry Date</dt>
            <dd>{{ $employeeLicense->expiry_date }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $employeeLicense->file) }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeLicense->status }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeLicense->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeLicense->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeLicense->approved_at }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeLicense->note }}</dd>

        </dl>

    </div>
</div>

@endsection