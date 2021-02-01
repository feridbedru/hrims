@extends('layouts.app')
@section('pagetitle')
    Edit Organization Location
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('organization_locations.organization_location.index') }}">Organization Locations</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-default">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title mb-1">Edit Organization Location</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('organization_locations.organization_location.update', $organizationLocation->id) }}"
                id="edit_organization_location_form" name="edit_organization_location_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('settings.organization_locations.form', [
                'organizationLocation' => $organizationLocation,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('organization_locations.organization_location.index') }}" class="btn btn-warning"
                            title="Show All Organization Location">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection