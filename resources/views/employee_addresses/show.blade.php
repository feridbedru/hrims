@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Address' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_addresses.employee_address.destroy', $employeeAddress->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_addresses.employee_address.index') }}" class="btn btn-primary" title="Show All Employee Address">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_addresses.employee_address.create') }}" class="btn btn-success" title="Create New Employee Address">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_addresses.employee_address.edit', $employeeAddress->id ) }}" class="btn btn-primary" title="Edit Employee Address">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Address" onclick="return confirm(&quot;Click Ok to delete Employee Address.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeAddress->employee)->en_name }}</dd>
            <dt>Address Type</dt>
            <dd>{{ optional($employeeAddress->addressType)->name }}</dd>
            <dt>Address</dt>
            <dd>{{ $employeeAddress->address }}</dd>
            <dt>House Number</dt>
            <dd>{{ $employeeAddress->house_number }}</dd>
            <dt>Woreda</dt>
            <dd>{{ optional($employeeAddress->woreda)->name }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeAddress->status }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeAddress->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeAddress->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeAddress->approved_at }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeAddress->note }}</dd>

        </dl>

    </div>
</div>

@endsection