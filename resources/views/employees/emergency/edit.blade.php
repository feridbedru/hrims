@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Emergency'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_emergencies.employee_emergency.index', $employee) }}">{{(__('employee.Emergency'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Emergency'))}}</h3>
        </div>
        <div class="card-body">
            @permission('emergencies_edit')
            <form method="POST"
                action="{{ route('employee_emergencies.employee_emergency.update', ['employee' => $employee->id, 'employeeEmergency' => $employeeEmergency->id]) }}"
                id="edit_employee_emergency_form" name="edit_employee_emergency_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.emergency.form', [
                'employeeEmergency' => $employeeEmergency,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_emergencies.employee_emergency.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Emergency">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
