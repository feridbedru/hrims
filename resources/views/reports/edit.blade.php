@extends('layouts.app')
@section('pagetitle')
{{(__('setting.Edit Report'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reports.report.index') }}">{{(__('setting.Reports'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('setting.Edit Report'))}}</h3>
        </div>
        <div class="card-body">
            @permission('setting_Reports_Edit')
            <form method="POST" action="{{ route('reports.report.update', $report->id) }}" id="edit_report_form"
                name="edit_report_form" accept-charset="UTF-8" class="form-horizontal">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('reports.form', [
                'report' => $report,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('reports.report.index') }}" class="btn btn-warning mr-5"
                            title="Show All Report">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
            @endpermission
        </div>
    </div>
@endsection
