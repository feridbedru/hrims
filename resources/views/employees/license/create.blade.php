@extends('layouts.employee')
@section('pagetitle')
    New License
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_licenses.employee_license.index') }}">License</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New License</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_licenses.employee_license.store') }}" accept-charset="UTF-8"
                id="create_employee_license_form" name="create_employee_license_form" class="form-horizontal"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.license.form', [
                'employeeLicense' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('employee_licenses.employee_license.index') }}" class="btn btn-warning mr-5"
                            title="Show All License">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
