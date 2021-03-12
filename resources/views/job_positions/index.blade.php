@extends('layouts.app')
@section('pagetitle')
    Job Positions
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Job Positions</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Job Positions List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($jobPositions) == 0)
                <h4 class="text-center">No Job Positions Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Organization Unit</th>
                            <th>Position Code</th>
                            <th>Position ID</th>
                            <th>Salary</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jobPositions as $jobPosition)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jobPosition->jobTitleCategories->name }}</td>
                                <td>{{ $jobPosition->organizationUnits->en_name }}</td>
                                <td>{{ $jobPosition->position_code }}</td>
                                <td>{{ $jobPosition->position_id }}</td>
                                <td>{{ $jobPosition->salarys->amount }}</td>
                                <td>{{ ($jobPosition->status) ? 'Yes' : 'No' }}</td>

                            <td>
                                <form method="POST" action="{!! route('job_positions.job_position.destroy', $jobPosition->id) !!}" accept-charset="UTF-8">
                                @method('DELETE')
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('job_positions.job_position.benefits', $jobPosition->id ) }}" class="btn btn-outline-success" title="Benefits">
                                            Benefits
                                        </a>
                                        <a href="{{ route('job_positions.job_position.show', $jobPosition->id ) }}" class="btn btn-primary" title="Show Job Position">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('job_positions.job_position.edit', $jobPosition->id ) }}" class="btn btn-warning" title="Edit Job Position">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Job Position" onclick="return confirm(&quot;Click Ok to delete Job Position.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $jobPositions->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('job_positions.job_position.create') }}" class="btn btn-success" title="Create New Job Position">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection