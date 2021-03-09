@extends('layouts.app')
@section('pagetitle')
    Show Report
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reports.report.index') }}">Report</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{ isset($report->name) ? $report->name : 'Report' }}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
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
        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd>{{ $report->name }}</dd>
                <dt>Description</dt>
                <dd>{{ $report->description }}</dd>
                <dt>Query</dt>
                <dd>{{ $report->query }}</dd>
                <dt>Is Active</dt>
                <dd>{{ $report->is_active ? 'Yes' : 'No' }}</dd>
            </dl>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="report_table">
                <thead>
                    <tr>
                        @foreach ($results as $key => $header)
                            @if ($loop->first)
                                @foreach ($header as $key => $col)
                                    <th>{{ $key }}</th>
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                </thead>
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
        </div>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/scroller.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#report_table').DataTable({
                paging: false,
                info: false,
                colReorder: true,
                scrollX: true,
                dom: '<"wrapper clearfix"Bfrp>',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }, {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                columnDefs: [{
                    targets: 3,
                    orderable: false
                }]
            });
            $("#report_table_filter").addClass("d-inline float-right");
            $("<hr>").insertBefore("#report_table");
        });

    </script>
@endsection
