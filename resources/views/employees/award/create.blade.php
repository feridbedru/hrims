@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Award'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee_awards.employee_award.index', $employee) }}">{{(__('employee.Awards'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Award'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_awards.employee_award.store', $employee) }}"
                accept-charset="UTF-8" id="create_employee_award_form" name="create_employee_award_form"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.award.form', [
                'employeeAward' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_awards.employee_award.index', $employee) }}"
                            class="btn btn-warning mr-5" title="Show All Awards">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
