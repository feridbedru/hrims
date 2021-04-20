@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Judiciary Punishment'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.index', $employee) }}">{{(__('employee.Judiciary Punishment'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Judiciary Punishment'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.update', ['employee' => $employee->id, 'employeeJudiciaryPunishment' => $employeeJudiciaryPunishment->id]) }}"
                id="edit_employee_judiciary_punishment_form" name="edit_employee_judiciary_punishment_form"
                accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.judiciary_punishment.form', [
                'employeeJudiciaryPunishment' => $employeeJudiciaryPunishment,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_judiciary_punishments.employee_judiciary_punishment.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Employee Judiciary Punishment">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
