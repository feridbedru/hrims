@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Experience'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_experiences.employee_experience.index',$employee) }}">{{(__('employee.Experience'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Experience'))}}</h3>
        </div>
        <div class="card-body">
            @permission('experience_addNew')
            <form method="POST" action="{{ route('employee_experiences.employee_experience.store',$employee) }}"
                accept-charset="UTF-8" id="create_employee_experience_form" name="create_employee_experience_form"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.experience.form', [
                'employeeExperience' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_experiences.employee_experience.index',$employee) }}"
                            class="btn btn-warning mr-5" title="Show All Experience">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
