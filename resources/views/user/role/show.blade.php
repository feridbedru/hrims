@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.Show Role') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('roles.role.index') }}">{{ __('setting.Role') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.Show') }}</li>
@endsection
@section('content')
@permission('roles_show')
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="mt-5 mb-5">{{ isset($roles->name) ? $roles->name : 'Roles' }}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('roles.roles.destroy', $roles->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        @permission('roles_edit')
                        <a href="{{ route('roles.roles.edit', $roles->id) }}" class="btn btn-warning" title="Edit Roles">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        @endpermission
                        @permission('roles_delete')
                        <button type="submit" class="btn btn-danger" title="Delete Roles"
                            onclick="return confirm(&quot;Click Ok to delete Roles.?&quot;)">
                            <span class="fa fa-trash text-white" aria-hidden="true"></span>
                        </button>
                        @endpermission
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd>{{ $roles->name }}</dd>
                <dt>Description</dt>
                <dd>{{ $roles->description }}</dd>
                <dt>Display Name</dt>
                <dd>{{ $roles->display_name }}</dd>
                <dt>Permission Name</dt>
                <dd>
                    @foreach ($permissions as $permission)
                        @if (in_array($permission->id, $selectedPermission))
                            <option value="{{ $permission->id }}" selected>{{ $permission->name }}</option>
                        @endif
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>
    @endpermission
@endsection
