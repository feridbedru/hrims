@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Evaluation Questions'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('employee.Evaluation Questions'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('employee.Evaluation Questions List'))}}</h3>
        </div>

        <div class="card-body"> 
            @permission('evaluation_question_list') 
        @if(count($evaluationQuestions) == 0)
                <h4 class="text-center">{{(__('employee.No Evaluation Questions Available.'))}}</h4>
        @else
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{(__('employee.Evaluation'))}}</th> 
                    <th>{{(__('employee.Criteria'))}}</th> 
                    <th>{{(__('employee.Weight'))}}</th> 
                    <th>{{(__('employee.Order'))}}</th> 
                    <th>{{(__('employee.Status'))}}</th> 
                    <th>{{(__('setting.Actions'))}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($evaluationQuestions as $evaluationQuestion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $evaluationQuestion->evaluation->title }}</td>
                    <td>{{ $evaluationQuestion->criteria }}</td>
                    <td>{{ $evaluationQuestion->weight }}</td>
                    <td>{{ $evaluationQuestion->order }}</td>
                    <td>{{ $evaluationQuestion->status }}</td>
                    <td>
                        <form method="POST" action="{!! route('evaluation_questions.evaluation_question.destroy', $evaluationQuestion->id) !!}" accept-charset="UTF-8">
                            @method('DELETE')
                            {{ csrf_field() }}
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                @permission('evaluation_question_show')
                                <a href="{{ route('evaluation_questions.evaluation_question.show', $evaluationQuestion->id ) }}" class="btn btn-primary" title="Show Evaluation Question">
                                    <span class="fa fa-eye" aria-hidden="true"></span>
                                </a>
                                @endpermission
                                @permission('evaluation_question_edit')
                                <a href="{{ route('evaluation_questions.evaluation_question.edit', $evaluationQuestion->id ) }}" class="btn btn-warning" title="Edit Evaluation Question">
                                    <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                </a>
                                @endpermission
                                @permission('evaluation_question_delete')
                                <button type="submit" class="btn btn-danger" title="Delete Evaluation Question" onclick="return confirm(&quot;Click Ok to delete Evaluation Question.&quot;)">
                                    <span class="fa fa-trash" aria-hidden="true"></span>
                                </button>
                                @endpermission
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-2">
            {!! $evaluationQuestions->links() !!}
        </div>
    @endif
    @endpermission
    </div>
</div>
@permission('evaluationQuestions_new')
    <a href="{{ route('evaluation_questions.evaluation_question.create') }}" class="btn btn-success mr-2" title="Create New Evaluation Question">
    <span class="fa fa-plus" aria-hidden="true">  {{(__('setting.AddNew'))}}</span>
    </a>
@endpermission
@endsection