@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Address'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_addresses.employee_address.index', $employee) }}">{{(__('employee.Address'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('setting.edit')}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Address'))}}</h3>
        </div>
        <div class="card-body">
            @permission('address_edit')
            <form method="POST"
                action="{{ route('employee_addresses.employee_address.update', ['employee' => $employee->id, 'employeeAddress' => $employeeAddress->id]) }}"
                id="edit_employee_address_form" name="edit_employee_address_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.address.form', [
                'employeeAddress' => $employeeAddress,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{__('setting.update')}}">
                        <a href="{{ route('employee_addresses.employee_address.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Address">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
