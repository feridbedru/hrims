@extends('layouts.app')
@section('pagetitle')
    {{(__('employee.Edit Leave Type'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('leave_types.leave_type.index') }}">{{(__('employee.Leave Type'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Leave Type'))}}</h3>
        </div>
        <div class="card-body">
            @permission('leave_types_edit')
            <form method="POST" action="{{ route('leave_types.leave_type.update', $leaveType->id) }}" id="edit_leave_type_form" name="edit_leave_type_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            @method('DELETE')
            @include ('leave.leave_types.form', [
                'leaveType' => $leaveType,
            ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('leave_types.leave_type.index') }}" class="btn btn-warning mr-5" title="Show All Leave Type">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection