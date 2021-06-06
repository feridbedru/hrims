@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Education'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_educations.employee_education.index',$employee) }}">{{((__('employee.Education')))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Education'))}}</h3>
        </div>
        <div class="card-body">
            @permission('educations_edit')
            <form method="POST"
                action="{{ route('employee_educations.employee_education.update', ['employee' => $employee->id, 'employeeEducation' => $employeeEducation->id]) }}"
                id="edit_employee_education_form" name="edit_employee_education_form" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.education.form', [
                'employeeEducation' => $employeeEducation,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_educations.employee_education.index',$employee) }}" class="btn btn-warning mr-5"
                            title="Show All Education">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
