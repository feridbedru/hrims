@extends('layouts.employee')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee Language' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employee_languages.employee_language.destroy', $employeeLanguage->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employee_languages.employee_language.index') }}" class="btn btn-primary" title="Show All Employee Language">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employee_languages.employee_language.create') }}" class="btn btn-success" title="Create New Employee Language">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employee_languages.employee_language.edit', $employeeLanguage->id ) }}" class="btn btn-primary" title="Edit Employee Language">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee Language" onclick="return confirm(&quot;Click Ok to delete Employee Language.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Employee</dt>
            <dd>{{ optional($employeeLanguage->employee)->en_name }}</dd>
            <dt>Language</dt>
            <dd>{{ optional($employeeLanguage->language)->name }}</dd>
            <dt>Reading</dt>
            <dd>{{ optional($employeeLanguage->languageLevel)->name }}</dd>
            <dt>Writing</dt>
            <dd>{{ optional($employeeLanguage->languageLevel)->name }}</dd>
            <dt>Listening</dt>
            <dd>{{ optional($employeeLanguage->languageLevel)->name }}</dd>
            <dt>Speaking</dt>
            <dd>{{ optional($employeeLanguage->languageLevel)->name }}</dd>
            <dt>Is Prefered</dt>
            <dd>{{ ($employeeLanguage->is_prefered) ? 'Yes' : 'No' }}</dd>
            <dt>Created By</dt>
            <dd>{{ optional($employeeLanguage->creator)->name }}</dd>

        </dl>

    </div>
</div>

@endsection