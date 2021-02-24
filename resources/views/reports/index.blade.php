@extends('layouts.app')
@section('pagetitle')
    Reports
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">Reports</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Reports List</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">  
        @if(count($reports) == 0)
                <h4 class="text-center">No Reports Available.</h4>
        @else
        <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Query</th>
                            <th>Is Active</th>
                            <th>Created By</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->query }}</td>
                            <td>{{ ($report->is_active) ? 'Yes' : 'No' }}</td>
                            <td>{{ optional($report->creator)->name }}</td>

                            <td>
                                <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('reports.report.show', $report->id ) }}" class="btn btn-primary" title="Show Report">
                                            <span class="fa fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('reports.report.edit', $report->id ) }}" class="btn btn-warning" title="Edit Report">
                                            <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Report" onclick="return confirm(&quot;Click Ok to delete Report.&quot;)">
                                            <span class="fa fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            {!! $reports->render() !!}
        @endif
        </div>
    </div>
    <div class="btn-group btn-group-sm pull-right" role="group">
        <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
            <span class="fa fa-plus" aria-hidden="true"> Add New</span>
        </a>
    </div>
@endsection