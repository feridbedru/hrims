@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Disaster Witness'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index', $employee) }}">{{(__('employee.Disaster Witness'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header clearfix">
        <span class="card-title">
            <h4>{{ __('employee.Employee Disaster Witness') }}</h4>
        </span>
        <div class="card-tools">
            <form method="POST" action="{!! route('employee_disaster_witnesses.employee_disaster_witness.destroy', $employeeDisasterWitness->id) !!}" accept-charset="UTF-8">
            @method('DELETE')
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
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
            <dt>{{(__('employee.Employee Disaster'))}}</dt>
            <dd>{{ $employeeDisasterWitness->disasters->occured_on }}</dd>
            <dt>{{(__('setting.Name'))}}</dt>
            <dd>{{ $employeeDisasterWitness->name }}</dd>
            <dt>{{(__('setting.PhoneNumber'))}}</dt>
            <dd>{{ $employeeDisasterWitness->phone }}</dd>
            <dt>{{(__('employee.File'))}}</dt>
            <dd>{{ asset('storage/' . $employeeDisasterWitness->file) }}</dd>
        </dl>
    </div>
</div>

@endsection