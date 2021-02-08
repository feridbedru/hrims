@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($template->title) ? $template->title : 'Template' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('templates.template.destroy', $template->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('templates.template.index') }}" class="btn btn-primary" title="Show All Template">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('templates.template.create') }}" class="btn btn-success" title="Create New Template">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('templates.template.edit', $template->id ) }}" class="btn btn-primary" title="Edit Template">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Template" onclick="return confirm(&quot;Click Ok to delete Template.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $template->title }}</dd>
            <dt>Body</dt>
            <dd>{{ $template->body }}</dd>
            <dt>Language</dt>
            <dd>{{ optional($template->language)->name }}</dd>
            <dt>Template Type</dt>
            <dd>{{ optional($template->templateType)->name }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($template->is_active) ? 'Yes' : 'No' }}</dd>
            <dt>Code</dt>
            <dd>{{ $template->code }}</dd>

        </dl>

    </div>
</div>

@endsection