@extends('layouts.employee')
@section('pagetitle')
    Edit Additional Info
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_additional_infos.employee_additional_info.index', $employee) }}">Employee Additional
            Info</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Employee Additional Info</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_additional_infos.employee_additional_info.update', ['employee' => $employee->id, 'employeeAdditionalInfo' => $employeeAdditionalInfo->id]) }}"
                id="edit_employee_additional_info_form" name="edit_employee_additional_info_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.additional_info.form', [
                'employeeAdditionalInfo' => $employeeAdditionalInfo,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_additional_infos.employee_additional_info.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Additional Info">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
