@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.New Role') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('roles.role.index') }}">{{ __('setting.Role') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.New') }}</li>
@endsection
@section('content')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }} ">
@endsection

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title mb-1">{{ __('setting.Create New Role') }}</h3>
    </div>

    <div class="card-body">
        @permission('roles_addNew')
        <form method="POST" action="{{ route('roles.roles.store') }}" accept-charset="UTF-8" id="create_roles_form"
            name="create_roles_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('roles.form', [
            'roles' => null,
            ])

            <div class="form-group">
                <div class="btn-group btn-group pull-left mb-2" role="group">
                    <input class="btn btn-primary" type="submit" value="{{ __('setting.save') }}">
                    <a href="{{ route('roles.roles.index') }}" class="btn btn-primary btn-lg" title="Show All Roles">
                        {{ __('setting.cancel') }}
                    </a>
                    <input class="btn btn-danger" type="reset" value="{{ __('setting.Reset') }}">
                </div>
            </div>
        </form>
        @endpermission
    </div>
</div>
@endsection