@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.New Evaluation Type'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluation_types.evaluation_type.index') }}">{{(__('employee.Evaluation Type'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Evaluation Type'))}}</h3>
        </div>
        <div class="card-body">
            {{-- @permission('evaluation_type_new') --}}
            <form method="POST" action="{{ route('evaluation_types.evaluation_type.store') }}" accept-charset="UTF-8" id="create_evaluation_type_form"
                name="create_evaluation_type_form" class="form-horizontal" >
                {{ csrf_field() }}
                @include ('evaluation.evaluation_types.form', [
                'evaluationType' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('evaluation_types.evaluation_type.index') }}" class="btn btn-warning mr-5"
                            title="Show All Evaluation Type">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            {{-- @endpermission --}}
        </div>
    </div>
@endsection
