@extends('layouts.app')
@section('pagetitle')
    Organization Units
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('organizations.organization.index') }}"> Organization </a></li>
    <li class="breadcrumb-item active">Units</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Search and Filter</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('organization_units.organization_unit.filter') }}" method="POST" accept-charset="UTF-8"
                id="filter_organization_unit_form" name="filter_organization_unit_form" class="form-horizontal">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="form-group col-md-2">
                        <select class="form-control" name="job_category_id" id="job_category_id">
                            <option value="NULL">Select Job Category</option>
                            @foreach ($jobCategories as $key => $jobCategory)
                                <option value="{{ $key }}">
                                    {{ $jobCategory }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" name="organization_location_id" id="organization_location_id">
                            <option value="NULL">Select Organization Location</option>
                            @foreach ($organizationLocations as $key => $organizationLocation)
                                <option value="{{ $key }}">
                                    {{ $organizationLocation }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" placeholder="enter name here" class="form-control" id="organization_unit_name"
                            name="organization_unit_name">
                    </div>
                    <div class="form-group col-md-2 d-flex justify-content-between">
                        <input type="submit" class="btn btn-success btn-md  mr-3" value="Filter">
                        <a href="{{ route('organization_units.organization_unit.index') }}" class="btn btn-danger mr-5"
                            title="Show All Organization Unit">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Organization Units List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if (count($organizationUnits) == 0)
                <h4 class="text-center">No Organization Units Available.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>English Name</th>
                            <th>Chairman</th>
                            <th>Location</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizationUnits as $organizationUnit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $organizationUnit->en_name }}</td>
                                <td>{{ optional($organizationUnit->chairman)->name }}</td>
                                <td>{{ optional($organizationUnit->locations)->name }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                    <a href="{{ route('organization_units.organization_unit.show', $organizationUnit->id) }}"
                                        class="btn btn-outline-danger btn-sm" title="Show Sub Offices">
                                        Offices
                                    </a>
                                    <a href="{{ route('organization_units.organization_unit.show', $organizationUnit->id) }}"
                                        class="btn btn-outline-primary btn-sm" title="Show Employees">
                                        Employees
                                    </a>
                                    <a href="{{ route('organization_units.organization_unit.show', $organizationUnit->id) }}"
                                        class="btn btn-outline-success btn-sm" title="Show Jobs">
                                        Jobs
                                    </a>
                                    <a href="{{ route('organization_units.organization_unit.show', $organizationUnit->id) }}"
                                        class="btn btn-outline-warning btn-sm" title="Show Organization Unit">
                                        Details
                                    </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $organizationUnits->render() !!}
            @endif
        </div>
    </div>
    @if (count($organizations) > 0)
        <a href="{{ route('organization_units.organization_unit.create') }}" class="btn btn-success"
            title="Create New Organization Unit">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
        @endif
@endsection
