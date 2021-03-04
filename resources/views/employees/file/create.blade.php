@extends('layouts.employee')
@section('pagetitle')
    New File
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_files.employee_file.index') }}">File</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New File</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_files.employee_file.store') }}" accept-charset="UTF-8"
                id="create_employee_file_form" name="create_employee_file_form" class="form-horizontal"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.file.form', [
                'employeeFile' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('employee_files.employee_file.index') }}" class="btn btn-warning mr-5"
                            title="Show All File">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
