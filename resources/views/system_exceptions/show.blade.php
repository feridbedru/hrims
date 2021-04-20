@extends('layouts.app')
@section('pagetitle')
{{(__('employee.View System Exception'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('system_exceptions.system_exception.index') }}">{{(__('employee.System Exception'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.view'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">{{(__('employee.View System Exception'))}}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('system_exceptions.system_exception.destroy', $systemException->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('system_exceptions.system_exception.edit', $systemException->id) }}"
                            class="btn btn-warning" title="Edit System Exception">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete System Exception"
                            onclick="return confirm(&quot;Click Ok to delete System Exception.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>{{(__('setting.Title'))}}</dt>
                <dd>{{ $systemException->title }}</dd>
                <dt>{{(__('setting.Function'))}}</dt>
                <dd>{{ $systemException->function }}</dd>
                <dt>{{(__('setting.Path'))}}</dt>
                <dd>{{ $systemException->path }}</dd>
                <dt>{{(__('setting.Request'))}}</dt>
                <dd>{{ $systemException->request }}</dd>
                <dt>{{(__('setting.Message'))}}</dt>
                <dd>{{ $systemException->message }}</dd>
                <dt>{{(__('setting.Status'))}}</dt>
                <dd>{{ $systemException->status }}</dd>
            </dl>
        </div>
    </div>
@endsection