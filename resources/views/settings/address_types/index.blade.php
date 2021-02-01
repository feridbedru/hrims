@extends('layouts.app')
@section('pagetitle')
    Address Types
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Address Types</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Address Types List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($addressTypes) == 0)
                <h4 class="text-center">No Address Types Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addressTypes as $addressType)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $addressType->name }}</td>
                                <td>{{ $addressType->description }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('address_types.address_type.destroy', $addressType->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('address_types.address_type.edit', $addressType->id) }}"
                                                class="btn btn-warning" title="Edit Address Type">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger" title="Delete Address Type"
                                                onclick="return confirm(&quot;Click Ok to delete Address Type.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $addressTypes->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('address_types.address_type.create') }}" class="btn btn-success" title="Create New Address Type">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection
