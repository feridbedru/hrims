@extends('layouts.app')
@section('pagetitle')
    Organization
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Organization</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Organization List</h3>
        </div>
        <div class="card-body">
            @if (count($organizations) == 0)
                <div class="panel-body text-center">
                    <h4>No Organizations Available.</h4>
                </div>
            @else

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Website</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Actions</th>
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
                                    <a href="{{ route('organizations.organization.show', $organization->id) }}"
                                        class="btn btn-outline-info mr-3" title="Show Organization">
                                        View
                                    </a>
                                    <a href="{{ route('organizations.organization.edit', $organization->id) }}"
                                        class="btn btn-outline-warning mr-3" title="Edit Organization">
                                        Edit
                                    </a>
                                    <form method="POST" class="d-inline" action="{!! route('organizations.organization.destroy', $organization->id) !!}"
                                        accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-outline-danger" title="Delete Organization"
                                            onclick="return confirm(&quot;Click Ok to delete Organization.&quot;)">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $organizations->render() !!}
            @endif
        </div>
    </div>
    @if (count($organizations) == 0)
        <a href="{{ route('organizations.organization.create') }}" class="btn btn-success"
            title="Create New Organization">
            <span class="fas fa-plus" aria-hidden="true"> Add New</span>
        </a>
    @endif
@endsection
