@extends('layouts.app')
@section('pagetitle')
    {{ __('setting.Permission') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('setting.Permission') }}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('setting.Permission List') }}</h3>
        </div>

        <div class="card-body">
            @permission('permissions_list')
            @if (count($permissionsObjects) == 0)
                <h4 class="text-center">{{ __('setting.No Permissions Available') }}.</h4>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('setting.Number') }}</th>
                            <th>{{ __('setting.Name') }}</th>
                            <th>{{ __('setting.Display Name') }}</th>
                            <th>{{ __('setting.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissionsObjects as $permissions)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permissions->name }}</td>
                                <td>{{ $permissions->display_name }}</td>
                                <td>
                                    <form method="POST" action="{!! route('permissions.permission.destroy', $permissions->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('permissions_show')
                                            <a href="{{ route('permissions.permission.show', $permissions->id) }}"
                                                class="btn btn-primary ml-2" title="Show permissions">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('permissions_edit')
                                            <a href="{{ route('permissions.permission.edit', $permissions->id) }}"
                                                class="btn btn-warning ml-2" title="Edit permissions">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('permissions_delete')
                                            <button type="submit" class="btn btn-danger ml-2" title="Delete Role"
                                                onclick="return confirm(&quot;Click Ok to delete Attendance.&quot;)">
                                                <span class="fa fa-trash text-white" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                    {!! $permissionsObjects->links() !!}
                </div>
        </div>
        @endif
        @endpermission
    </div>
</div>
    @permission('permissions_addNew')
    <a href="{{ route('permissions.permission.create') }}" class="btn btn-success" title="Create New Permissions">
        <span class="fa fa-plus" aria-hidden="true"> {{ __('setting.AddNew') }}</span>
    </a>
    @endpermission
@endsection
