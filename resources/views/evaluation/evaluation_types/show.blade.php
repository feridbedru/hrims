@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Show Evaluation Type'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('evaluation_types.evaluation_type.index') }}">{{(__('employee.Evaluation Type'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('content')
@permission('evaluation_type_show')
<div class="card card-primary">
    <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Evaluation Type')}}</h4>
        <div class="card-tools">
            <form method="POST" action="{!! route('evaluation_types.evaluation_type.destroy', $evaluationType->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @permission('evaluation_type_edit')
                    <a href="{{ route('evaluation_types.evaluation_type.edit', $evaluationType->id ) }}" class="btn btn-warning" title="Edit Evaluation Type">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    @endpermission
                    @permission('evaluation_type_delete')
                    <button type="submit" class="btn btn-danger" title="Delete Evaluation Type" onclick="return confirm(&quot;Click Ok to delete Evaluation Type.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                    @endpermission
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ __('employee.Name') }}</dt>
            <dd>{{ $evaluationType->name }}</dd>
            <dt>{{ __('employee.Description') }}</dt>
            <dd>{{ $evaluationType->description }}</dd>
        </dl>
    </div>
</div>
@endpermission
@endsection