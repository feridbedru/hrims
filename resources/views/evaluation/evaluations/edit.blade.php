@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Edit Evaluation'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluations.evaluation.index') }}">{{(__('employee.Evaluation'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Evaluation'))}}</h3>
        </div>
        <div class="card-body">
            @permission('evaluation_edit')
            <form method="POST" action="{{ route('evaluations.evaluation.update', $evaluation->id) }}" id="edit_evaluation_form" name="edit_evaluation_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            @method('DELETE')
            @include ('evaluation.evaluations.form', [
                'evaluation' => $evaluation,
            ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('evaluations.evaluation.index') }}" class="btn btn-warning mr-5" title="Show All Evaluation">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection