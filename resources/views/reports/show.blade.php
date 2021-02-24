@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">

            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ isset($report->name) ? $report->name : 'Report' }}</h4>
            </span>

            <div class="pull-right">

                <form method="POST" action="{!!  route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{ route('reports.report.index') }}" class="btn btn-primary" title="Show All Report">
                            <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('reports.report.edit', $report->id) }}" class="btn btn-primary"
                            title="Edit Report">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Report"
                            onclick="return confirm(&quot;Click Ok to delete Report.?&quot;)">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>

            </div>

        </div>

        <div class="panel-body">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd>{{ $report->name }}</dd>
                <dt>Description</dt>
                <dd>{{ $report->description }}</dd>
                <dt>Query</dt>
                <dd>{{ $report->query }}</dd>
                <dt>Is Active</dt>
                <dd>{{ $report->is_active ? 'Yes' : 'No' }}</dd>
                <dt>Created By</dt>
                <dd>{{ optional($report->creator)->name }}</dd>
            </dl>

        </div>
    </div>
    <table class="table table-striped table-hover">
        @foreach ($results as $key => $header)
            @if ($loop->first)
                @foreach ($header as $key => $col)
                    <th>{{ $key }}</th>

                @endforeach
            @endif
        @endforeach
        <tbody>
            @foreach ($results as $result)
                <tr>
                    @foreach ($result as $data)
                        <td>{{ $data }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
