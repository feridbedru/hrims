@extends('layouts.app')
@section('pagetitle')
    {{ $help->title }} Help
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('helps.help.index') }}">Helps</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $help->title }}</h3>
            <div class="card-tools">
                <form method="POST" action="{!!  route('helps.help.destroy', $help->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('helps.help.create') }}" class="btn btn-success" title="Create New Help">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>
                        <a href="{{ route('helps.help.edit', $help->id) }}" class="btn btn-warning" title="Edit Help">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        <button type="submit" class="btn btn-danger" title="Delete Help"
                            onclick="return confirm(&quot;Click Ok to delete Help.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
                </button>
            </div>
        </div>
        <div class="card-body">
            <dl class="dl-horizontal">
                <div class="row">
                    @if (isset($help->description))
                        <div class="col-md-4">
                            <dt>Description</dt>
                            <dd>{{ $help->description }}</dd>
                        </div>
                    @endif
                    <div class="col-md-3">
                        <dt>Topic For</dt>
                        <dd>{{ $help->topic_for }}</dd>
                    </div>
                    @if (isset($help->parent))
                        <div class="col-md-2">
                            <dt>Parent</dt>
                            <dd>{{ optional($help->helpes)->id }}</dd>
                        </div>
                    @endif
                    <div class="col-md-2">
                        <dt>Language</dt>
                        <dd>{{ optional($help->languagers)->name }}</dd>
                    </div>
                </div>
                <hr>
                <dt>Data</dt>
                <dd>{!! $help->data !!}</dd>
            </dl>
        </div>
    </div>
@endsection