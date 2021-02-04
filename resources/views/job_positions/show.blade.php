@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Job Position' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('job_positions.job_position.destroy', $jobPosition->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('job_positions.job_position.index') }}" class="btn btn-primary" title="Show All Job Position">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('job_positions.job_position.create') }}" class="btn btn-success" title="Create New Job Position">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('job_positions.job_position.edit', $jobPosition->id ) }}" class="btn btn-primary" title="Edit Job Position">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Job Position" onclick="return confirm(&quot;Click Ok to delete Job Position.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Organization Unit</dt>
            <dd>{{ optional($jobPosition->organizationUnit)->en_name }}</dd>
            <dt>Job Title Category</dt>
            <dd>{{ optional($jobPosition->jobTitleCategory)->name }}</dd>
            <dt>Job Category</dt>
            <dd>{{ optional($jobPosition->jobCategory)->name }}</dd>
            <dt>Job Type</dt>
            <dd>{{ optional($jobPosition->jobType)->name }}</dd>
            <dt>Job Description</dt>
            <dd>{{ $jobPosition->job_description }}</dd>
            <dt>Position Code</dt>
            <dd>{{ $jobPosition->position_code }}</dd>
            <dt>Position ID</dt>
            <dd>{{ $jobPosition->position_id }}</dd>
            <dt>Salary</dt>
            <dd>{{ optional($jobPosition->salary)->created_at }}</dd>
            <dt>Status</dt>
            <dd>{{ ($jobPosition->status) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection