@extends('layouts.app')
@section('pagetitle')
    Edit Job Position
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('job_positions.job_position.index') }}">Job Position</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Job Position</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('job_positions.job_position.update', $jobPosition->id) }}" id="edit_job_position_form" name="edit_job_position_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('job_positions.form', [
                                        'jobPosition' => $jobPosition,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('job_positions.job_position.index') }}" class="btn btn-warning mr-5" title="Show All Job Position">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection