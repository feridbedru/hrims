@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.Edit Role') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('roles.role.index') }}">{{ __('setting.Role') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.Edit') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{ __('setting.Edit Role') }}</h3>
        </div>
        <div class="card-body">
            @permission('permissions_edit')
            <form method="POST" action="{{ route('roles.role.update', $roles->id) }}" id="edit_roles_form"
                name="edit_roles_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('user.roles.edit_role', [
                'roles' => $roles,
                ])

                <div class="form-group mt-5">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{ __('setting.update') }}">
                        <a href="{{ route('roles.role.index') }}" class="btn btn-warning mr-5" title="Show All Roles">
                            {{ __('setting.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
