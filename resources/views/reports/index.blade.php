@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Reports'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item active">{{(__('setting.Reports'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{(__('setting.Reports List'))}}</h3>
        </div>

        <div class="card-body">
            @permission('report_list')
            @if (count($reports) == 0)
                <h4 class="text-center">{{(__('setting.No Reports Available'))}}.</h4>
            @else
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{(__('setting.Number'))}}</th>
                            <th>{{(__('setting.Name'))}}</th>
                            <th>{{(__('setting.Description'))}}</th>
                            <th>{{(__('setting.Active'))}}</th>
                            <th>{{(__('setting.Actions'))}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->name }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->is_active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form method="POST" action="{!! route('reports.report.destroy', $report->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            @permission('setting_Reports_Show')
                                            <a href="{{ route('reports.report.show', $report->id) }}"
                                                class="btn btn-primary" title="Show Report">
                                                <span class="fa fa-eye" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('setting_Reports_Edit')
                                            <a href="{{ route('reports.report.edit', $report->id) }}"
                                                class="btn btn-warning" title="Edit Report">
                                                <span class="fa fa-edit text-white" aria-hidden="true"></span>
                                            </a>
                                            @endpermission
                                            @permission('setting_Reports_Delete')
                                            <button type="submit" class="btn btn-danger" title="Delete Report"
                                                onclick="return confirm(&quot;Click Ok to delete Report.&quot;)">
                                                <span class="fa fa-trash" aria-hidden="true"></span>
                                            </button>
                                            @endpermission
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-2">
                {{ $reports->links() }}
                </div>
            @endif
            @endpermission
        </div>
    </div>
    @permission('setting_Reports_AddNew')
        <a href="{{ route('reports.report.create') }}" class="btn btn-success" title="Create New Report">
            <span class="fa fa-plus" aria-hidden="true"> {{(__('setting.AddNew'))}}</span>
        </a>
        @endpermission
@endsection
