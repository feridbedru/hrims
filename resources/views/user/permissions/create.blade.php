@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.New Permission') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('permissions.permission.index') }}">{{ __('setting.Permission') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.New') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{ __('setting.Create New Permission') }}</h3>
        </div>

        <div class="card-body">
            @permission('permissions_addNew')
            <form method="POST" action="{{ route('permissions.permission.store') }}" accept-charset="UTF-8"
                id="create_permissions_form" name="create_permissions_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('user.permissions.form', [
                'permissions' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('permissions.permission.index') }}" class="btn btn-warning mr-5"
                        title="Show All Permissions">
                        {{(__('setting.cancel'))}}
                    </a>
                    <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
