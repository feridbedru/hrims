@extends('layouts.app')
@section('pagetitle')
    Show Job Position
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('job_positions.job_position.index') }}">Job Position</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">Show Job Position</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('job_positions.job_position.destroy', $jobPosition->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('job_positions.job_position.edit', $jobPosition->id) }}"
                            class="btn btn-warning" title="Edit Job Position">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Job Position"
                            onclick="return confirm(&quot;Click Ok to delete Job Position.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Organization Unit</dt>
                <dd>{{ $jobPosition->organizationUnits->en_name }}</dd>
                <dt>Job Title Category</dt>
                <dd>{{ $jobPosition->jobTitleCategories->name }}</dd>
                <dt>Job Category</dt>
                <dd>{{ $jobPosition->jobCategorys->name }}</dd>
                <dt>Job Type</dt>
                <dd>{{ $jobPosition->jobTypes->name }}</dd>
                <dt>Job Description</dt>
                <dd>{{ $jobPosition->job_description }}</dd>
                <dt>Position Code</dt>
                <dd>{{ $jobPosition->position_code }}</dd>
                <dt>Position ID</dt>
                <dd>{{ $jobPosition->position_id }}</dd>
                <dt>Salary</dt>
                <dd>{{ $jobPosition->salarys->amount }}</dd>
                <dt>Available</dt>
                <dd>{{ $jobPosition->status ? 'Yes' : 'No' }}</dd>
            </dl>
            <h2> List benefits here </h2>
        </div>
    </div>
@endsection
