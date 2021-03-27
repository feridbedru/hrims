@extends('layouts.app')
@section('pagetitle')
    Jobs
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">Organization Unit</a>
    </li>
    <li class="breadcrumb-item active">Jobs</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Jobs List</h3>
        </div>
        <div class="card-body">
            @if (count($jobs) == 0)
                <h4 class="text-center">No Jobs in this Units.</h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Type</th>
                            <th>Category</th>
                            <th>Position Code</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $job->jobTypes->name }}</td>
                                <td>{{ $job->jobCategorys->name }}</td>
                                <td>{{ $job->position_code }}</td>
                                <td>Br. {{ $job->salarys->amount }}</td>
                                <td>
                                    <a href="{{ route('job_positions.job_position.show', $job->id) }}"
                                        class="btn btn-primary" title="Show Job Position">
                                        View Details
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
        </div>
    </div>

@endsection
