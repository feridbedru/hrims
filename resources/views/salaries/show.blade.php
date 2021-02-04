@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Salary' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('salaries.salary.destroy', $salary->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('salaries.salary.index') }}" class="btn btn-primary" title="Show All Salary">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('salaries.salary.create') }}" class="btn btn-success" title="Create New Salary">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('salaries.salary.edit', $salary->id ) }}" class="btn btn-primary" title="Edit Salary">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Salary" onclick="return confirm(&quot;Click Ok to delete Salary.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Salary Height</dt>
            <dd>{{ optional($salary->salaryHeight)->created_at }}</dd>
            <dt>Salary Step</dt>
            <dd>{{ optional($salary->salaryStep)->created_at }}</dd>
            <dt>Amount</dt>
            <dd>{{ $salary->amount }}</dd>

        </dl>

    </div>
</div>

@endsection