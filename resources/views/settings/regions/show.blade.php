@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($region->name) ? $region->name : 'Region' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('regions.region.destroy', $region->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('regions.region.index') }}" class="btn btn-primary" title="Show All Region">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('regions.region.create') }}" class="btn btn-success" title="Create New Region">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('regions.region.edit', $region->id ) }}" class="btn btn-primary" title="Edit Region">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Region" onclick="return confirm(&quot;Click Ok to delete Region.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $region->name }}</dd>
            <dt>Code</dt>
            <dd>{{ $region->code }}</dd>

        </dl>

    </div>
</div>

@endsection