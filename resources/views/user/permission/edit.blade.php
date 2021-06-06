@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.Edit Permission') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('permissions.permission.index') }}">{{ __('setting.Permission') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.Edit') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <div class="pull-left">
                <h3 class="card-title mb-1">{{ __('setting.Edit Permission') }}</h3>
            </div>
        </div>

        <div class="card-body">
            @permission('permissions_edit')
            <form method="POST" action="{{ route('permissions.permissions.update', $permissions->id) }}"
                id="edit_permissions_form" name="edit_permissions_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('permissions.form', [
                'permissions' => $permissions,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('permissions.permissions.index') }}" class="btn btn-warning mr-5"
                            title="Show All Permissions">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection