@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewSalaryHeight'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salary_heights.salary_height.index') }}">{{(__('setting.SalaryHeight'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewSalaryHeight'))}}</h3>
        </div>
        <div class="card-body">
            @permission('salaryHeights_addNew')
            <form method="POST" action="{{ route('salary_heights.salary_height.store') }}" accept-charset="UTF-8"
                id="create_salary_height_form" name="create_salary_height_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('payment.salary_heights.form', [
                'salaryHeight' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('salary_heights.salary_height.index') }}" class="btn btn-warning mr-5"
                            title="Show All Salary Height">
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
