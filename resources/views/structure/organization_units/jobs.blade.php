@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Jobs'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">{{(__('setting.Organization Unit'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.Jobs'))}}</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.Jobs List'))}}</h3>
        </div>
        <div class="card-body">
            @permission('organization_units_jobs')
            @if (count($jobs) == 0)
                <h4 class="text-center">{{(__('setting.No Jobs in this Units'))}}.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Job Type'))}}</th>
                            <th>{{(__('setting.Category'))}}</th>
                            <th>{{(__('setting.Position Code'))}}</th>
                            <th>{{(__('setting.Salary'))}}</th>
                            <th>{{(__('setting.Action'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->jobTypes->name }}</td>
                                <td>{{ $job->jobCategorys->name }}</td>
                                <td>{{ $job->position_code }}</td>
                                <td>{{(__('setting.Br'))}}. {{ $job->salarys->amount }}</td>
                                <td>
                                    <a href="{{ route('job_positions.job_position.show', $job->id) }}"
                                        class="btn btn-primary" title="Show Job Position">
                                        {{(__('setting.View Details'))}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $jobs->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>

@endsection
