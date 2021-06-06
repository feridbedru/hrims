@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Emergency'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_emergencies.employee_emergency.index', $employee) }}">{{(__('employee.Emergency'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Emergency'))}}</h3>
        </div>
        <div class="card-body">
            @permission('emergencies_addNew')
            <form method="POST" action="{{ route('employee_emergencies.employee_emergency.store', $employee) }}"
                accept-charset="UTF-8" id="create_employee_emergency_form" name="create_employee_emergency_form"
                class="form-horizontal">
                {{ csrf_field() }}
                @include ('employees.emergency.form', [
                'employeeEmergency' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_emergencies.employee_emergency.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Emergency">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
