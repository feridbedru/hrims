@extends('layouts.app')
@section('pagetitle')
    Edit Address
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_addresses.employee_address.index') }}">Address</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Address</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_addresses.employee_address.update', $employeeAddress->id) }}"
                id="edit_employee_address_form" name="edit_employee_address_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.address.form', [
                'employeeAddress' => $employeeAddress,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_addresses.employee_address.index') }}" class="btn btn-warning mr-5"
                            title="Show All Address">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
