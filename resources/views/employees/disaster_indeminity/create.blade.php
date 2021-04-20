@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Disaster Indeminity'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index') }}">{{(__('employee.Disaster Indeminity'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Disaster Indeminity'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.store') }}"
                accept-charset="UTF-8" id="create_employee_disaster_indeminity_form"
                name="create_employee_disaster_indeminity_form" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.disaster_indeminity.form', [
                'employeeDisasterIndeminity' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index') }}"
                            class="btn btn-warning mr-5" title="Show All Disaster Indeminity">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
