@extends('layouts.app')
@section('pagetitle')
    Organization Locations
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item active">Organization Locations</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Organization Location List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (count($organizationLocations) == 0)
                <h4 class="text-center">No Organization Locations Available.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Coordinates</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizationLocations as $organizationLocation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $organizationLocation->name }}</td>
                                <td>{{ $organizationLocation->address }}</td>
                                <td>{{ $organizationLocation->cordinates }}</td>
                                <td>
                                    <form method="POST"
                                        action="{!!  route('organization_locations.organization_location.destroy', $organizationLocation->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="pull-right">
                                            <a href="{{ route('organization_locations.organization_location.edit', $organizationLocation->id) }}"
                                                class="btn btn-warning mr-1" title="Edit Organization Location">
                                                <span class="fa fa-edit" aria-hidden="true"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Organization Location"
                                                onclick="return confirm(&quot;Click Ok to delete Organization Location.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $organizationLocations->render() !!}
            @endif
        </div>
    </div>
    <a href="{{ route('organization_locations.organization_location.create') }}" class="btn btn-success"
        title="Create New Organization Location">
        <span class="fa fa-plus" aria-hidden="true"> Add New</span>
    </a>
@endsection