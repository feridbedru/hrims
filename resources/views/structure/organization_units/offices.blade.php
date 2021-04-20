@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Unit Offices'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">{{(__('setting.Organization Unit'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.Offices'))}}</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.Offices List'))}}</h3>
        </div>

        <div class="card-body">
            @if (count($units) == 0)
                <h4 class="text-center">{{(__('setting.No Offices Available'))}}.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.Job Category'))}}</th>
                            <th>{{(__('setting.Location'))}}</th>
                            <th>{{(__('setting.Action'))}}</th>
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
                                        {{(__('setting.View Details'))}}
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
