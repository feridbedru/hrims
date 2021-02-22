@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Award' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_awards.employee_award.destroy', $employeeAward->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_awards.employee_award.index') }}" class="btn btn-primary" title="Show All Employee Award">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_awards.employee_award.create') }}" class="btn btn-success" title="Create New Employee Award">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_awards.employee_award.edit', $employeeAward->id ) }}" class="btn btn-primary" title="Edit Employee Award">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Award" onclick="return confirm(&quot;Click Ok to delete Employee Award.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeAward->employee)->en_name }}</dd>
            <dt>Organization</dt>
            <dd>{{ $employeeAward->organization }}</dd>
            <dt>Description</dt>
            <dd>{{ $employeeAward->description }}</dd>
            <dt>Attachment</dt>
            <dd>{{ asset('storage/' . $employeeAward->attachment) }}</dd>
            <dt>Award Type</dt>
            <dd>{{ optional($employeeAward->awardType)->name }}</dd>
            <dt>Awarded On</dt>
            <dd>{{ $employeeAward->awarded_on }}</dd>
            <dt>Status</dt>
            <dd>{{ $employeeAward->status }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeAward->creator)->name }}</dd>
            <dt>Approved By</dt>
            <dd>{{ optional($employeeAward->approvedBy)->id }}</dd>
            <dt>Approved At</dt>
            <dd>{{ $employeeAward->approved_at }}</dd>
            <dt>Note</dt>
            <dd>{{ $employeeAward->note }}</dd>

        </dl>

    </div>
</div>

@endsection