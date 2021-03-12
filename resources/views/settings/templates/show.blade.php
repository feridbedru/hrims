@extends('layouts.app')
@section('pagetitle')
    View Template
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}">Setting</a></li>
    <li class="breadcrumb-item"><a href="{{ route('templates.template.index') }}">Templates</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">
            <h3 class="card-title">{{ $template->title }}</h3>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    <div class="col-md-3">
                        <dt>Language</dt>
                        <dd>{{ $template->languages->name }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>Template Type</dt>
                        <dd>{{ $template->types->name }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>Is Active</dt>
                        <dd>{{ $template->is_active ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="col-md-3">
                        <dt>Code</dt>
                        <dd>{{ $template->code }}</dd>
                    </div>
                </div>
                <hr>
                <dt>Body</dt>
                <dd>
                    {!! $template->body !!}
                </dd>
            </dl><hr>
            <form method="POST" action="{!! route('templates.template.destroy', $template->id) !!}" accept-charset="UTF-8">
                @method('DELETE')
                {{ csrf_field() }}
                <div>
                    <a href="{{ route('templates.template.edit', $template->id) }}" class="btn btn-warning mr-2"
                        title="Edit Template">
                        <span class="fa fa-edit text-white" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Template"
                        onclick="return confirm(&quot;Click Ok to delete Template.?&quot;)">
                        <span class="fa fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
