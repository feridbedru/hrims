@extends('layouts.app')
@section('pagetitle')
    New Job Position
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('job_positions.job_position.index') }}">Job Position</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Job Position</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('job_positions.job_position.store') }}" accept-charset="UTF-8"
                id="create_job_position_form" name="create_job_position_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('job_positions.form', [
                'jobPosition' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('job_positions.job_position.index') }}" class="btn btn-warning mr-5"
                            title="Show All Job Position">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
