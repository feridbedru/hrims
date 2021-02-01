@extends('layouts.app')
@section('pagetitle')
    New Disaster Cause
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('disaster_causes.disaster_cause.index') }}">Disaster Cause</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Disaster Cause</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('disaster_causes.disaster_cause.store') }}" accept-charset="UTF-8"
                id="create_disaster_cause_form" name="create_disaster_cause_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.disaster_causes.form', [
                'disasterCause' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Add">
                        <a href="{{ route('disaster_causes.disaster_cause.index') }}" class="btn btn-warning mr-5"
                            title="Show All Disaster Cause">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
