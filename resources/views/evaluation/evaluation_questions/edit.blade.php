@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Edit Evaluation Question'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluation_questions.evaluation_question.index') }}">{{(__('employee.Evaluation Question'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Evaluation Question'))}}</h3>
        </div>
        <div class="card-body">
            @permission('evaluation_question_edit')
            <form method="POST" action="{{ route('evaluation_questions.evaluation_question.update', $evaluationQuestion->id) }}" id="edit_evaluation_question_form" name="edit_evaluation_question_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            @include ('evaluation.evaluation_questions.form', [
                'evaluationQuestion' => $evaluationQuestion,
            ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('evaluation_questions.evaluation_question.index') }}" class="btn btn-warning mr-5" title="Show All Evaluation Question">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection