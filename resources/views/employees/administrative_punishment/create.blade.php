@extends('layouts.employee')
@section('pagetitle')
    New Administrative Punishment
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_administrative_punishments.employee_administrative_punishment.index', $employee) }}">
            Administrative Punishment</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Administrative Punishment</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_administrative_punishments.employee_administrative_punishment.store', $employee) }}"
                accept-charset="UTF-8" id="create_employee_administrative_punishment_form"
                name="create_employee_administrative_punishment_form" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.administrative_punishment.form', [
                'employeeAdministrativePunishment' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Administrative Punishment">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection