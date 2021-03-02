@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Organization Unit' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('organization_units.organization_unit.destroy', $organizationUnit->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('organization_units.organization_unit.index') }}" class="btn btn-primary" title="Show All Organization Unit">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('organization_units.organization_unit.create') }}" class="btn btn-success" title="Create New Organization Unit">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('organization_units.organization_unit.edit', $organizationUnit->id ) }}" class="btn btn-primary" title="Edit Organization Unit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Organization Unit" onclick="return confirm(&quot;Click Ok to delete Organization Unit.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>English Name</dt>
            <dd>{{ $organizationUnit->en_name }}</dd>
            <dt>English Acronym</dt>
            <dd>{{ $organizationUnit->en_acronym }}</dd>
            <dt>Amharic Name</dt>
            <dd>{{ $organizationUnit->am_name }}</dd>
            <dt>Amharic Acronym</dt>
            <dd>{{ $organizationUnit->am_acronym }}</dd>
            <dt>Parent</dt>
            <dd>{{ optional($organizationUnit->organizationUnit)->id }}</dd>
            <dt>Job Category</dt>
            <dd>{{ optional($organizationUnit->jobCategory)->name }}</dd>
            <dt>Organization Location</dt>
            <dd>{{ optional($organizationUnit->organizationLocation)->name }}</dd>
            <dt>Is Root Unit</dt>
            <dd>{{ ($organizationUnit->is_root_unit) ? 'Yes' : 'No' }}</dd>
            <dt>Is Category</dt>
            <dd>{{ ($organizationUnit->is_category) ? 'Yes' : 'No' }}</dd>
            <dt>Phone Number</dt>
            <dd>{{ $organizationUnit->phone_number }}</dd>
            <dt>Email Address</dt>
            <dd>{{ $organizationUnit->email_address }}</dd>
            <dt>Web Page</dt>
            <dd>{{ $organizationUnit->web_page }}</dd>

        </dl>

    </div>
</div>

@endsection