@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Salary Height' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('salary_heights.salary_height.destroy', $salaryHeight->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('salary_heights.salary_height.index') }}" class="btn btn-primary" title="Show All Salary Height">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('salary_heights.salary_height.create') }}" class="btn btn-success" title="Create New Salary Height">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('salary_heights.salary_height.edit', $salaryHeight->id ) }}" class="btn btn-primary" title="Edit Salary Height">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Salary Height" onclick="return confirm(&quot;Click Ok to delete Salary Height.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Salary Scale</dt>
            <dd>{{ $salaryHeight->salaryScales->name }}</dd>
            <dt>Level</dt>
            <dd>{{ $salaryHeight->level }}</dd>
            <dt>Initial Salary</dt>
            <dd>{{ $salaryHeight->initial_salary }}</dd>
            <dt>Maximum Salary</dt>
            <dd>{{ $salaryHeight->maximum_salary }}</dd>

        </dl>

    </div>
</div>

@endsection