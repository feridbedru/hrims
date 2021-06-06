@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit Organization'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organizations.organization.index') }}">{{(__('setting.Organization'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Organization'))}}</h3>
        </div>
        <div class="card-body">
            @permission('Organization_edit')
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
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('organizations.organization.index') }}" class="btn btn-warning mr-5"
                            title="Show All Organization">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection