@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit File'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_files.employee_file.index', $employee) }}">{{(__('employee.File'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit File'))}}</h3>
        </div>
        <div class="card-body">
            @permission('files_edit')
            <form method="POST"
                action="{{ route('employee_files.employee_file.update', ['employee' => $employee->id, 'employeeFile' => $employeeFile->id]) }}"
                id="edit_employee_file_form" name="edit_employee_file_form" accept-charset="UTF-8" class="form-horizontal"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.file.form', [
                'employeeFile' => $employeeFile,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_files.employee_file.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All File">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
