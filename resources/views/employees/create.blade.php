@extends('layouts.app')
@section('pagetitle')
{{(__('setting.New Employee'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employees.employee.index') }}">{{(__('setting.Employee'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Employee'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employees.employee.store') }}" accept-charset="UTF-8"
                id="create_employee_form" name="create_employee_form" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.form', [
                'employee' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employees.employee.index') }}" class="btn btn-warning mr-5"
                            title="Show All Employee">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
