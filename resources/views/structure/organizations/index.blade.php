@extends('layouts.app')
@section('pagetitle')
{{__('setting.Organization')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{__('setting.Organization')}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.OrganizationList'))}}</h3>
        </div>
        <div class="card-body">
            @if (count($organizations) == 0)
                <div class="panel-body text-center">
                    <h4>{{__('setting.NoOrganizationLocationsAvailable')}}.</h4>
                </div>
            @else

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.Website'))}}</th>
                            <th>{{(__('setting.Email'))}}</th>
                            <th>{{(__('setting.PhoneNumber'))}} </th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizations as $organization)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $organization->am_name }}</td>
                                <td>{{ $organization->website }}</td>
                                <td>{{ $organization->email }}</td>
                                <td>{{ $organization->phone_number }}</td>
                                <td>
                                    <a href="{{ route('organizations.organization.structure') }}"
                                        class="btn btn-outline-primary mr-3" title="Show Organization Structure">
                                        {{(__('setting.Structure'))}}
                                    </a>
                                    <a href="{{ route('organizations.organization.show', $organization->id) }}"
                                        class="btn btn-outline-info mr-3" title="Show Organization">
                                        {{(__('setting.view'))}}
                                    </a>
                                    <a href="{{ route('organizations.organization.edit', $organization->id) }}"
                                        class="btn btn-outline-warning mr-3" title="Edit Organization">
                                        {{(__('setting.edit'))}}
                                    </a>
                                    <form method="POST" class="d-inline" action="{!! route('organizations.organization.destroy', $organization->id) !!}"
                                        accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-outline-danger" title="Delete Organization"
                                            onclick="return confirm(&quot;Click Ok to delete Organization.&quot;)">
                                            {{(__('setting.delete'))}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $organizations->links() }}
                </div>
            @endif
        </div>
    </div>
    @if (count($organizations) == 0)
        <a href="{{ route('organizations.organization.create') }}" class="btn btn-success"
            title="Create New Organization">
            <span class="fas fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
        </a>
    @endif
@endsection
