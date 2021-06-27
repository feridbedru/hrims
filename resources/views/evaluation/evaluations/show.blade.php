@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Show Evaluation'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluations.evaluation.index') }}">{{(__('employee.Evaluation'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('content')
@permission('evaluation_show')
<div class="card card-primary">
    <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Evaluation')}}</h4>
        <div class="card-tools">
            <form method="POST" action="{!! route('evaluations.evaluation.destroy', $evaluation->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @permission('evaluation_edit')
                    <a href="{{ route('evaluations.evaluation.edit', $evaluation->id ) }}" class="btn btn-primary" title="Edit Evaluation">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    @endpermission
                    @permission('evaluation_delete')
                    <button type="submit" class="btn btn-danger" title="Delete Evaluation" onclick="return confirm(&quot;Click Ok to delete Evaluation.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                    @endpermission
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
             <dt>{{ __('employee.Title') }}</dt>
            <dd>{{ $evaluation->title }}</dd>
            <dt>{{ __('employee.Description') }}</dt>
            <dd>{{ $evaluation->description }}</dd>
            <dt>{{ __('employee.Time Period') }}</dt>
            <dd>{{ $evaluation->time_period }}</dd>
            <dt>{{ __('employee.Start Date') }}</dt>
            <dd>{{ $evaluation->start_date }}</dd>
            <dt>{{ __('employee.End Date') }}</dt>
            <dd>{{ $evaluation->end_date }}</dd>
            <dt>{{ __('employee.Evaluation Type') }}</dt>
            <dd>{{ optional($evaluation->evaluationType)->name }}</dd>
            <dt>{{ __('employee.Job Category') }}</dt>
            <dd>{{ optional($evaluation->jobCategory)->name }}</dd>
            <dt>{{ __('employee.Organization Units') }}</dt>
            <dd>{{ optional($evaluation->organizationUnit)->am_acronym }}</dd>
            <dt>{{ __('employee.Self') }}</dt>
            <dd>{{ $evaluation->self }}</dd>
            <dt>{{ __('employee.Peer') }}</dt>
            <dd>{{ $evaluation->peer }}</dd>
            <dt>{{ __('employee.Team Leader') }}</dt>
            <dd>{{ $evaluation->team_leader }}</dd>
            <dt>{{ __('employee.Unit Leader') }}</dt>
            <dd>{{ $evaluation->unit_leader }}</dd>
            <dt>{{ __('employee.Status') }}</dt>
            <dd>{{ $evaluation->status }}</dd>
        </dl>
    </div>
</div>
@endpermission
@endsection