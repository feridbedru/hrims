@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Edit Evaluation Type'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluation_types.evaluation_type.index') }}">{{(__('employee.Evaluation Type'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Evaluation Type'))}}</h3>
        </div>
        <div class="card-body">
            @permission('evaluation_type_edit')
            <form method="POST" action="{{ route('evaluation_types.evaluation_type.update', $evaluationType->id) }}" id="edit_evaluation_type_form" name="edit_evaluation_type_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            @method('DELETE')
            @include ('evaluation_types.form', [
                'evaluation.evaluationType' => $evaluationType,
            ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('evaluation_types.evaluation_type.index') }}" class="btn btn-warning mr-5" title="Show All Evaluation Type">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection