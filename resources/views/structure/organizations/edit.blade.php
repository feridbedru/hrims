@extends('layouts.app')
@section('pagetitle')
    Edit Organization
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organizations.organization.index') }}">Organization</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Organization</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('organizations.organization.update', $organization->id) }}"
                id="edit_organization_form" name="edit_organization_form" accept-charset="UTF-8" class="form-horizontal"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('structure.organizations.form', [
                'organization' => $organization,
                ])
                <div class="form-group text-center mt-2">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('organizations.organization.index') }}" class="btn btn-warning mr-5"
                            title="Show All Organization">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection