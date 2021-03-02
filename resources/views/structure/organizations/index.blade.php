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
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
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

                                    <form method="POST"
                                        action="{!!  route('organizations.organization.destroy', $organization->id) !!}"
                                        accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}

                                        <div class=" pull-right">
                                            <a href="{{ route('organizations.organization.show', $organization->id) }}"
                                                class="btn-sm btn-info mr-3" title="Show Organization">
                                                <span class="fa fa-eye my-2" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ route('organizations.organization.edit', $organization->id) }}"
                                                class="btn-sm btn-warning mr-3" title="Edit Organization">
                                                <span class="fa fa-edit text-white text-center" aria-hidden="true"></span>
                                            </a>

                                            <button type="submit" class="btn-sm btn-danger" title="Delete Organization"
                                                onclick="return confirm(&quot;Click Ok to delete Organization.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                        </div>

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

    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('organizations.organization.create') }}" class="btn btn-success" title="Create New Organization">
            <span class="fas fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>

    </div>
@endsection
