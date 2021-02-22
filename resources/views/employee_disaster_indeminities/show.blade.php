@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeDisasterIndeminity->title) ? $employeeDisasterIndeminity->title : 'Employee Disaster Indeminity' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_disaster_indeminities.employee_disaster_indeminity.destroy', $employeeDisasterIndeminity->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index') }}" class="btn btn-primary" title="Show All Employee Disaster Indeminity">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.create') }}" class="btn btn-success" title="Create New Employee Disaster Indeminity">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.edit', $employeeDisasterIndeminity->id ) }}" class="btn btn-primary" title="Edit Employee Disaster Indeminity">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Disaster Indeminity" onclick="return confirm(&quot;Click Ok to delete Employee Disaster Indeminity.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee Disaster</dt>
            <dd>{{ optional($employeeDisasterIndeminity->employeeDisaster)->approved_at }}</dd>
            <dt>Title</dt>
            <dd>{{ $employeeDisasterIndeminity->title }}</dd>
            <dt>Description</dt>
            <dd>{{ $employeeDisasterIndeminity->description }}</dd>
            <dt>Cost</dt>
            <dd>{{ $employeeDisasterIndeminity->cost }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $employeeDisasterIndeminity->file) }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeDisasterIndeminity->creator)->name }}</dd>

        </dl>

    </div>
</div>

@endsection