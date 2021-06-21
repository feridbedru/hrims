@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.Show Permission') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('permissions.permission.index') }}">{{ __('setting.Permission') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('setting.Show') }}</li>
@endsection
@section('content')
@permission('permissions_show')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title mb-1">{{ __('setting.Show Permission') }}</h3>
        <div class="card-tools">
            <form method="POST" action="{!! route('permissions.permission.destroy', $permissions->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    @permission('permissions_edit')
                    <a href="{{ route('permissions.permission.edit', $permissions->id ) }}" class="btn btn-warning" title="Edit Permissions">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    @permission('permissions_delete')
                    <button type="submit" class="btn btn-danger" title="Delete Permissions" onclick="return confirm(&quot;Click Ok to delete Permissions.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                    @endpermission
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{(__('setting.Name'))}}</dt>
            <dd>{{ $permissions->name }}</dd>
            <dt>{{(__('setting.Description'))}}</dt>
            <dd>{{ $permissions->description }}</dd>
            <dt>{{(__('setting.Display Name'))}}</dt>
            <dd>{{ $permissions->display_name }}</dd>
        </dl>
    </div>
</div>
@endpermission
@endsection
