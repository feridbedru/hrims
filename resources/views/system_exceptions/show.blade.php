@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($systemException->title) ? $systemException->title : 'System Exception' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('system_exceptions.system_exception.destroy', $systemException->id) !!}" accept-charset="UTF-8">
            @method('DELETE')
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('system_exceptions.system_exception.index') }}" class="btn btn-primary" title="Show All System Exception">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('system_exceptions.system_exception.edit', $systemException->id ) }}" class="btn btn-primary" title="Edit System Exception">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete System Exception" onclick="return confirm(&quot;Click Ok to delete System Exception.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $systemException->title }}</dd>
            <dt>Function</dt>
            <dd>{{ $systemException->function }}</dd>
            <dt>Path</dt>
            <dd>{{ $systemException->path }}</dd>
            <dt>Request</dt>
            <dd>{{ $systemException->request }}</dd>
            <dt>Message</dt>
            <dd>{{ $systemException->message }}</dd>
            <dt>Status</dt>
            <dd>{{ $systemException->status }}</dd>

        </dl>

    </div>
</div>

@endsection