@extends('layouts.employee')
@section('pagetitle')
    Edit Administrative Punishment
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_administrative_punishments.employee_administrative_punishment.index', $employee) }}">Administrative
            Punishment</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Administrative Punishment</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_administrative_punishments.employee_administrative_punishment.update', ['employee' => $employee->id, 'employeeAdministrativePunishment' => $employeeAdministrativePunishment->id]) }}"
                id="edit_employee_administrative_punishment_form" name="edit_employee_administrative_punishment_form"
                accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.administrative_punishment.form', [
                'employeeAdministrativePunishment' => $employeeAdministrativePunishment,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_administrative_punishments.employee_administrative_punishment.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Administrative Punishment">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
