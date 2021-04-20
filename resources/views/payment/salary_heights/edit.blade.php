@extends('layouts.app')
@section('pagetitle')
{{(__('setting.EditSalaryHeight'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('salary_heights.salary_height.index') }}">{{(__('setting.SalaryHeight'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.EditSalaryHeight'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('salary_heights.salary_height.update', $salaryHeight->id) }}"
                id="edit_salary_height_form" name="edit_salary_height_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('payment.salary_heights.form', [
                'salaryHeight' => $salaryHeight,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('salary_heights.salary_height.index') }}" class="btn btn-warning mr-5"
                            title="Show All Salary Height">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
