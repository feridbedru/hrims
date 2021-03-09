@extends('layouts.app')
@section('pagetitle')
    New Report
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reports.report.index') }}">Report</a></li>
    <li class="breadcrumb-item active">New</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Create New Report</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('reports.report.store') }}" accept-charset="UTF-8"
                id="create_report_form" name="create_report_form" class="form-horizontal">
                {{ csrf_field() }}
                @include ('reports.form', [
                'report' => null,
                ])
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Save">
                        <a href="{{ route('reports.report.index') }}" class="btn btn-warning mr-5"
                            title="Show All Report">
                            Cancel
                        </a>
                        <input class="btn btn-danger" type="reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection