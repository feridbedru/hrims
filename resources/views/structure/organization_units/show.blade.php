@extends('layouts.app')
@section('pagetitle')
    Show Unit
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('organization_units.organization_unit.index') }}"> Units</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ $organizationUnit->en_name }} ({{ $organizationUnit->en_acronym }})</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('organization_units.organization_unit.destroy', $organizationUnit->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('organization_units.organization_unit.create') }}" class="btn btn-success"
                            title="Create New Organization Unit">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>
                        <a href="{{ route('organization_units.organization_unit.edit', $organizationUnit->id) }}"
                            class="btn btn-warning" title="Edit Organization Unit">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Organization Unit"
                            onclick="return confirm(&quot;Click Ok to delete Organization Unit.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                @if (isset($organizationUnit->am_name))
                    <dt>Amharic Name</dt>
                    <dd>{{ $organizationUnit->am_name }} ({{ $organizationUnit->am_acronym }})</dd>
                @endif
                @if (isset($organizationUnit->parents))
                    <dt>Parent</dt>
                    <dd>{{ $organizationUnit->parents->en_name }}</dd>
                @endif
                <dt>Job Category</dt>
                <dd>{{ $organizationUnit->jobCategorys->name }}</dd>
                @if (isset($organizationUnit->locations))
                    <dt>Location</dt>
                    <dd>{{ $organizationUnit->locations->name }}</dd>
                @endif
                @if (isset($organizationUnit->chairman))
                    <dt>Chairman</dt>
                    <dd>{{ $organizationUnit->chairman->name }}</dd>
                @endif
                <dt>Is Root Unit</dt>
                <dd>{{ $organizationUnit->is_root_unit ? 'Yes' : 'No' }}</dd>
                <dt>Is Category</dt>
                <dd>{{ $organizationUnit->is_category ? 'Yes' : 'No' }}</dd>
                <div class="row">
                    @if (isset($organizationUnit->phone_number))
                        <div class="col-md-4">
                            <dt>Phone Number</dt>
                            <dd>{{ $organizationUnit->phone_number }}</dd>
                        </div>
                    @endif
                    @if (isset($organizationUnit->email_address))
                        <div class="col-md-4">
                            <dt>Email Address</dt>
                            <dd>{{ $organizationUnit->email_address }}</dd>
                        </div>
                    @endif
                    @if (isset($organizationUnit->web_page))
                        <div class="col-md-4">
                            <dt>Web Page</dt>
                            <dd>{{ $organizationUnit->web_page }}</dd>
                        </div>
                    @endif
                </div>
            </dl>
        </div>
    </div>
@endsection
