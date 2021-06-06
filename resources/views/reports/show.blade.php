@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Show Report'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reports.report.index') }}">{{(__('setting.Report'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.Show'))}}</li>
@endsection
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header clearfix">
            <h4 class="card-title">{{(__('setting.Report'))}}</h4>
            <div class="card-tools">
                <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="btn-group btn-group-sm" role="group">
                        @permission('setting_Reports_Edit')
                        <a href="{{ route('reports.report.edit', $report->id) }}" class="btn btn-warning"
                            title="Edit Report">
                            <span class="fa fa-edit" aria-hidden="true"></span>
                        </a>
                        @endpermission
                        @permission('setting_Reports_Delete')
                        <button type="submit" class="btn btn-danger" title="Delete Report"
                            onclick="return confirm(&quot;Click Ok to delete Report.?&quot;)">
                            <span class="fa fa-trash" aria-hidden="true"></span>
                        </button>
                        @endpermission
                    </div>
                </form>
            </div>
        </div>
        @permission('setting_Reports_Show')
        <div class="card-body">
            <dl class="dl-horizontal">
                <dt>{{(__('setting.Name'))}}</dt>
                <dd>{{ $report->name }}</dd>
                <dt>{{(__('setting.Description'))}}</dt>
                <dd>{{ $report->description }}</dd>
                @permission('Reports_view_query')
                <dt>{{(__('setting.Query'))}}</dt>
                <dd>{{ $report->query }}</dd>
                @endpermission
                <dt>{{(__('setting.Is Active'))}}</dt>
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
    @endpermission
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
