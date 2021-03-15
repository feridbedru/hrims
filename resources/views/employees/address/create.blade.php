@extends('layouts.employee')
@section('pagetitle')
    New Address
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_addresses.employee_address.index', $employee) }}">Address</a>
    </li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Address</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_addresses.employee_address.store', $employee) }}"
                accept-charset="UTF-8" id="create_employee_address_form" name="create_employee_address_form"
                class="form-horizontal">
                {{ csrf_field() }}
                @include ('employees.address.form', [
                'employeeAddress' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('employee_addresses.employee_address.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Address">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
