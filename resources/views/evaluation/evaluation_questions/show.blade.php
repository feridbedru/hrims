@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Show Evaluation Question'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluation_questions.evaluation_question.index') }}">{{(__('employee.Evaluation Question'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('content')
@permission('evaluation_question_show')
<div class="card card-primary">
    <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Evaluation Question')}}</h4>
        <div class="card-tools">
            <form method="POST" action="{!! route('evaluation_questions.evaluation_question.destroy', $evaluationQuestion->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @permission('evaluation_question_edit')
                    <a href="{{ route('evaluation_questions.evaluation_question.edit', $evaluationQuestion->id ) }}" class="btn btn-primary" title="Edit Evaluation Question">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    @endpermission
                    @permission('evaluation_question_delete')
                    <button type="submit" class="btn btn-danger" title="Delete Evaluation Question" onclick="return confirm(&quot;Click Ok to delete Evaluation Question.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                    @endpermission
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
             <dt>{{ __('employee.Evaluation') }}</dt>
            <dd>{{ $evaluationQuestion->evaluation->title }}</dd>
            <dt>{{ __('employee.Criteria') }}</dt>
            <dd>{{ $evaluationQuestion->criteria }}</dd>
            <dt>{{ __('employee.Weight') }}</dt>
            <dd>{{ $evaluationQuestion->weight }}</dd>
            <dt>{{ __('employee.Order') }}</dt>
            <dd>{{ $evaluationQuestion->order }}</dd>
            <dt>{{ __('employee.Status') }}</dt>
            <dd>{{ $evaluationQuestion->status }}</dd>
        </dl>
    </div>
</div>
@endpermission
@endsection