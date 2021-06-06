@extends('layouts.app')
@section('pagetitle')
{{(__('setting.New Job Position'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('job_positions.job_position.index') }}">{{(__('setting.JobPosition'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.CreateNewJobPosition'))}}</h3>
        </div>
        <div class="card-body">
            @permission('jobsPosition_AddNew')
            <form method="POST" action="{{ route('job_positions.job_position.store') }}" accept-charset="UTF-8"
                id="create_job_position_form" name="create_job_position_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('job_positions.form', [
                'jobPosition' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('job_positions.job_position.index') }}" class="btn btn-warning mr-5"
                            title="Show All Job Position">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
