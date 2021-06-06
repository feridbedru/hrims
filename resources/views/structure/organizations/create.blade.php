@extends('layouts.app')
@section('pagetitle')
{{(__('setting.NewOrganization'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('organizations') }}">{{(__('setting.Organization'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.NewOrganization'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.CreateNewOrganization'))}}</h3>
        </div>
        <div class="card-body">
            @permission('organization_AddNew')
            <form method="POST" action="{{ route('organizations.organization.store') }}" accept-charset="UTF-8"
                id="create_organization_form" name="create_organization_form" class="form-horizontal"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('structure.organizations.form', ['organization' => null,])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10 text-center mt-4 m-2">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('organizations.organization.index') }}" class="btn btn-danger mr-5"
                            title="Show All Organization">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-warning" type="reset">
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection