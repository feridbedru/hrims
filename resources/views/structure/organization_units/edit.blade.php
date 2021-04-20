@extends('layouts.app')
@section('pagetitle')
{{(__('employee.Edit Organization Unit'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('organization_units.organization_unit.index') }}">{{(__('employee.Organization Unit'))}}</a>
    </li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Organization Unit'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('organization_units.organization_unit.update', $organizationUnit->id) }}"
                id="edit_organization_unit_form" name="edit_organization_unit_form" accept-charset="UTF-8"
                class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('structure.organization_units.form', [
                'organizationUnit' => $organizationUnit,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('organization_units.organization_unit.index') }}" class="btn btn-warning mr-5"
                            title="Show All Organization Unit">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
