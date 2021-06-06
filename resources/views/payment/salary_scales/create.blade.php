@extends('layouts.app')
@section('pagetitle')
{{(__('setting.New Salary Scale'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salary_scales.salary_scale.index') }}">{{(__('setting.Salary Scale'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.Create New Salary Scale'))}}</h3>
        </div>
        <div class="card-body">
            @permission('salaryScales_addNew')
            <form method="POST" action="{{ route('salary_scales.salary_scale.store') }}" accept-charset="UTF-8"
                id="create_salary_scale_form" name="create_salary_scale_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('payment.salary_scales.form', [
                'salaryScale' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('salary_scales.salary_scale.index') }}" class="btn btn-warning mr-5"
                            title="Show All Salary Scale">
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
