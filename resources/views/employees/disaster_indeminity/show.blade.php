@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.View Disaster Indeminity'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index', $employee) }}">{{(__('employee.Disaster Indeminity'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <span class="card-title">
                <h4>{{ __('employee.Employee Disaster Indeminity') }}</h4>
            </span>

            <div class="card-tools">
                <form method="POST" action="{!! route('employee_disaster_indeminities.employee_disaster_indeminity.destroy', $employeeDisasterIndeminity->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.edit', $employeeDisasterIndeminity->id) }}"
                            class="btn btn-primary" title="Edit Employee Disaster Indeminity">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Employee Disaster Indeminity"
                            onclick="return confirm(&quot;Click Ok to delete Employee Disaster Indeminity.?&quot;)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>{{ __('employee.Employee Disaster') }}</dt>
                <dd>{{ $employeeDisasterIndeminity->disasters->occured_on }}</dd>
                <dt>{{ __('employee.Title') }}</dt>
                <dd>{{ $employeeDisasterIndeminity->title }}</dd>
                <dt>{{ __('setting.Description') }}</dt>
                <dd>{{ $employeeDisasterIndeminity->description }}</dd>
                <dt>{{ __('employee.Cost') }}</dt>
                <dd>{{ $employeeDisasterIndeminity->cost }}</dd>
                <dt>{{ __('employe.File') }}</dt>
                <dd>{{ asset('storage/' . $employeeDisasterIndeminity->file) }}</dd>
            </dl>
        </div>
    </div>
@endsection