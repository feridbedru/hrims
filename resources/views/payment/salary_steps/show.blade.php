@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Salary Step' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('salary_steps.salary_step.destroy', $salaryStep->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('salary_steps.salary_step.index') }}" class="btn btn-primary" title="Show All Salary Step">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('salary_steps.salary_step.create') }}" class="btn btn-success" title="Create New Salary Step">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('salary_steps.salary_step.edit', $salaryStep->id ) }}" class="btn btn-primary" title="Edit Salary Step">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Salary Step" onclick="return confirm(&quot;Click Ok to delete Salary Step.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Salary Scale</dt>
            <dd>{{ $salaryStep->salaryScales->name }}</dd>
            <dt>Step</dt>
            <dd>{{ $salaryStep->step }}</dd>

        </dl>

    </div>
</div>

@endsection