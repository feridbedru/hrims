@extends('layouts.app')
@section('pagetitle')
    {{ __('employee.Show Evaluation') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('evaluations.evaluation.index') }}">{{ __('employee.Evaluation') }}</a></li>
    <li class="breadcrumb-item active">{{ __('setting.Show') }}</li>
@endsection
@section('content')
    {{-- @permission('evaluation_show') --}}
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Evaluation') }}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('evaluations.evaluation.destroy', $evaluation->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        {{-- @permission('evaluation_edit') --}}
                        <a href="{{ route('evaluations.evaluation.edit', $evaluation->id) }}" class="btn btn-warning"
                            title="Edit Evaluation">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        {{-- @endpermission --}}
                        {{-- @permission('evaluation_delete') --}}
                        <button type="submit" class="btn btn-danger" title="Delete Evaluation"
                            onclick="return confirm(&quot;Click Ok to delete Evaluation.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                        {{-- @endpermission --}}
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-3">
                        <dt>{{ __('employee.Title') }}</dt>
                        <dd>{{ $evaluation->title }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Time Period') }}</dt>
                        <dd>{{ $evaluation->time_period }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Start Date') }}</dt>
                        <dd>{{ $evaluation->start_date }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.End Date') }}</dt>
                        <dd>{{ $evaluation->end_date }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <dt>{{ __('employee.Self') }}</dt>
                        <dd>{{ $evaluation->self }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Peer') }}</dt>
                        <dd>{{ $evaluation->peer }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Team Leader') }}</dt>
                        <dd>{{ $evaluation->team_leader }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Unit Leader') }}</dt>
                        <dd>{{ $evaluation->unit_leader }}</dd>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <dt>{{ __('employee.Evaluation Type') }}</dt>
                        <dd>{{ $evaluation->evaluationType->name }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Job Category') }}</dt>
                        <dd>{{ $evaluation->jobCategory->name }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Organization Units') }}</dt>
                        <dd>{{ $evaluation->organizationUnit->en_acronym }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>{{ __('employee.Status') }}</dt>
                        <dd>{{ $evaluation->status ? 'Active' : 'Status' }}</dd>
                    </div>
                </div>
                <dt>{{ __('employee.Description') }}</dt>
                <dd>{{ $evaluation->description }}</dd>
            </dl>
        </div>
    </div>
    {{-- @endpermission --}}

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Evaluate') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluations.evaluation.evaluate', $evaluation->id)}}" method="POST" accept-charset="UTF-8" id="evaluate_employee_form" name="evaluate_employee_form"
            class="form-horizontal">
                @foreach ($evaluationQuestions as $evaluationQuestion)
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <label for="evaluation_question_id">{{ $evaluationQuestion->order }}. {{ $evaluationQuestion->criteria }}</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" onblur="findTotal()" class="form-control" name="evaluation_question"
                                id="evaluation_question{{ $evaluationQuestion->order }}" required="true" min="0"
                                max="{{ $evaluationQuestion->weight }}">
                        </div>
                    </div>
                @endforeach
                <div class="row mb-4">
                    <div class="col-md-8">
                        <label for="total">Total</label>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="total" id="total" disabled>
                    </div>
                </div>
                <input class="btn btn-block btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript">
        function findTotal() {
            var arr = document.getElementsByName('evaluation_question');
            var tot = 0;
            for (var i = 0; i < arr.length; i++) {
                if (parseInt(arr[i].value))
                    tot += parseInt(arr[i].value);
            }
            document.getElementById('total').value = tot;
        }
    </script>

@endsection
