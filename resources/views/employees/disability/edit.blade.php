@extends('layouts.employee')
@section('pagetitle')
    {{ __('employee.Edit Disability') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('employee_disabilities.employee_disability.index', $employee) }}">{{ __('employee.Disability') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.edit') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{ __('employee.Edit Disability') }}</h3>
        </div>
        <div class="card-body">
            @permission('disabilities_edit')
            <form method="POST"
                action="{{ route('employee_disabilities.employee_disability.update', ['employee' => $employee->id, 'employeeDisability' => $employeeDisability->id]) }}"
                id="edit_employee_disability_form" name="edit_employee_disability_form" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.disability.form', [
                'employeeDisability' => $employeeDisability,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{ __('setting.update') }}">
                        <a href="{{ route('employee_disabilities.employee_disability.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Disability">
                            {{ __('setting.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
