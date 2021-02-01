@extends('layouts.app')
@section('pagetitle')
    New Organization Location
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('organization_locations.organization_location.index') }}">Organization Locations</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Organization Location</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('organization_locations.organization_location.store') }}"
                accept-charset="UTF-8" id="create_organization_location_form" name="create_organization_location_form"
                class="form-horizontal">
                {{ csrf_field() }}
                @include ('settings.organization_locations.form', [
                'organizationLocation' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center mt-4 m-2">
                        <input class="btn btn-primary mr-5" type="submit" value="Submit">
                        <a href="{{ route('organization_locations.organization_location.index') }}"
                            class="btn btn-warning mr-5" title="Show All Organization Location">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
