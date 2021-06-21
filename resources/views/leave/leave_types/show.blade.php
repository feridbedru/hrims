@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Show Leave Type'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('leave_types.leave_type.index') }}">{{(__('employee.Leave Type'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('content')
@permission('leave_types_show')
<div class="card card-primary">
    <div class="card-header clearfix">
            <h4 class="card-title">{{ __('employee.Leave Type')}}</h4>
        <div class="card-tools">
            <form method="POST" action="{!! route('leave_types.leave_type.destroy', $leaveType->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @permission('leave_types_edit')
                    <a href="{{ route('leave_types.leave_type.edit', $leaveType->id ) }}" class="btn btn-primary" title="Edit Leave Type">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    @endpermission
                    @permission('leave_types_delete')
                    <button type="submit" class="btn btn-danger" title="Delete Leave Type" onclick="return confirm(&quot;Click Ok to delete Leave Type.?&quot;)">
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
            <dd>{{ $leaveType->name }}</dd>
            <dt>{{ __('employee.Description') }}</dt>
            <dd>{{ $leaveType->description }}</dd>
            <dt>{{ __('employee.Job Type') }}</dt>
            <dd>{{ optional($leaveType->jobType)->name }}</dd>
            <dt>{{ __('employee.Initial') }}</dt>
            <dd>{{ $leaveType->initial }}</dd>
            <dt>{{ __('employee.Maximum') }}</dt>
            <dd>{{ $leaveType->maximum }}</dd>
            <dt>{{ __('employee.Male') }}</dt>
            <dd>{{ $leaveType->male }}</dd>
            <dt>{{ __('employee.Female') }}</dt>
            <dd>{{ $leaveType->female }}</dd>
            <dt>{{ __('employee.Includes Offdays') }}</dt>
            <dd>{{ ($leaveType->includes_offdays) ? 'Yes' : 'No' }}</dd>
            <dt>{{ __('employee.Is Transferable') }}</dt>
            <dd>{{ ($leaveType->is_transferable) ? 'Yes' : 'No' }}</dd>
            <dt>{{ __('employee.Pre Post') }}</dt>
            <dd>{{ $leaveType->pre_post }}</dd>
            <dt>{{ __('employee.Is Active') }}</dt>
            <dd>{{ ($leaveType->is_active) ? 'Yes' : 'No' }}</dd>
        </dl>
    </div>
</div>
@endpermission
@endsection