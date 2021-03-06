@extends('layouts.app')

@section('content')

    <div class="card card-primary">
        <div class="card-header clearfix">

                <h4 class="card-title">{{ isset($report->name) ? $report->name : 'Report' }}</h4>

            <div class="card-tools">

                <form method="POST" action="{!!  route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">

                        <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </a>

                        <a href="{{ route('reports.report.edit', $report->id) }}" class="btn btn-warning"
                            title="Edit Report">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>

                        <button type="submit" class="btn btn-danger" title="Delete Report"
                            onclick="return confirm(&quot;Click Ok to delete Report.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
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
