@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Show Job Position'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('job_positions.job_position.index') }}">{{(__('setting.JobPosition'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('setting.Show Job Position'))}}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('job_positions.job_position.destroy', $jobPosition->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        @permission('jobsPosition_edit')
                        <a href="{{ route('job_positions.job_position.edit', $jobPosition->id) }}"
                            class="btn btn-warning" title="Edit Job Position">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        @endpermission
                        @permission('jobsPosition_delete')
                        <button type="submit" class="btn btn-danger" title="Delete Job Position"
                            onclick="return confirm(&quot;Click Ok to delete Job Position.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                        @endpermission
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            @permission('jobsPosition_show')
            <dl class="dl-horizontal">
                <dt>{{(__('employee.Organization Unit'))}}</dt>
                <dd>{{ $jobPosition->organizationUnits->en_name }}</dd>
                <dt>{{(__('employee.Job Title Category'))}}</dt>
                <dd>{{ $jobPosition->jobTitleCategories->name }}</dd>
                <dt>{{(__('employee.Job Category'))}}</dt>
                <dd>{{ $jobPosition->jobCategorys->name }}</dd>
                <dt>{{(__('employee.Job Type'))}}</dt>
                <dd>{{ $jobPosition->jobTypes->name }}</dd>
                <dt>{{(__('employee.Job Description'))}}</dt>
                <dd>{{ $jobPosition->job_description }}</dd>
                <dt>{{(__('employee.Position Code'))}}</dt>
                <dd>{{ $jobPosition->position_code }}</dd>
                <dt>{{(__('employee.Position ID'))}}</dt>
                <dd>{{ $jobPosition->position_id }}</dd>
                <dt>{{(__('employee.Salary'))}}</dt>
                <dd>{{ $jobPosition->salarys->amount }}</dd>
                <dt>{{(__('employee.Available'))}}</dt>
                <dd>{{ $jobPosition->status ? 'Yes' : 'No' }}</dd>
            </dl>
            <h2> List benefits here </h2>
            @endpermission
        </div>
    </div>
@endsection
