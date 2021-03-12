@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($employeeDisasterWitness->name) ? $employeeDisasterWitness->name : 'Employee Disaster Witness' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_disaster_witnesses.employee_disaster_witness.destroy', $employeeDisasterWitness->id) !!}" accept-charset="UTF-8">
            @method('DELETE')
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index') }}" class="btn btn-primary" title="Show All Employee Disaster Witness">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.create') }}" class="btn btn-success" title="Create New Employee Disaster Witness">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.edit', $employeeDisasterWitness->id ) }}" class="btn btn-primary" title="Edit Employee Disaster Witness">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Disaster Witness" onclick="return confirm(&quot;Click Ok to delete Employee Disaster Witness.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee Disaster</dt>
            <dd>{{ $employeeDisasterWitness->disasters->occured_on }}</dd>
            <dt>Name</dt>
            <dd>{{ $employeeDisasterWitness->name }}</dd>
            <dt>Phone</dt>
            <dd>{{ $employeeDisasterWitness->phone }}</dd>
            <dt>File</dt>
            <dd>{{ asset('storage/' . $employeeDisasterWitness->file) }}</dd>

        </dl>

    </div>
</div>

@endsection