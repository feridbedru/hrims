@extends('layouts.app')
@section('pagetitle')
    Unit Offices
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">Organization Unit</a>
    </li>
    <li class="breadcrumb-item active">Offices</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Offices List</h3>
        </div>

        <div class="card-body">
            @if (count($units) == 0)
                <h4 class="text-center">No Offices Available.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Job Category</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $unit->en_name }}</td>
                                <td>{{ $unit->jobCategorys->name }}</td>
                                <td>{{ $unit->locations->name }}</td>
                                <td><a href="{{ route('organization_units.organization_unit.show', $unit->id) }}"
                                        class="btn btn-primary btn-sm" title="Show Organization Unit">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
