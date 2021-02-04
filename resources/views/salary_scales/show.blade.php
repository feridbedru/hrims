@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($salaryScale->name) ? $salaryScale->name : 'Salary Scale' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('salary_scales.salary_scale.destroy', $salaryScale->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('salary_scales.salary_scale.index') }}" class="btn btn-primary" title="Show All Salary Scale">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('salary_scales.salary_scale.create') }}" class="btn btn-success" title="Create New Salary Scale">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('salary_scales.salary_scale.edit', $salaryScale->id ) }}" class="btn btn-primary" title="Edit Salary Scale">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Salary Scale" onclick="return confirm(&quot;Click Ok to delete Salary Scale.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $salaryScale->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $salaryScale->description }}</dd>
            <dt>Job Category</dt>
            <dd>{{ optional($salaryScale->jobCategory)->name }}</dd>
            <dt>Stair Height</dt>
            <dd>{{ $salaryScale->stair_height }}</dd>
            <dt>Salary Steps</dt>
            <dd>{{ $salaryScale->salary_steps }}</dd>
            <dt>Is Enabled</dt>
            <dd>{{ ($salaryScale->is_enabled) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection