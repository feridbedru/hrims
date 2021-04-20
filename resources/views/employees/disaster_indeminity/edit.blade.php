@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.Edit Disaster Indeminity'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index') }}">{{(__('employee.Disaster Indeminity'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.edit'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Edit Disaster Indeminity'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.update', $employeeDisasterIndeminity->id) }}"
                id="edit_employee_disaster_indeminity_form" name="edit_employee_disaster_indeminity_form"
                accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.disaster_indeminity.form', [
                'employeeDisasterIndeminity' => $employeeDisasterIndeminity,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.update'))}}">
                        <a href="{{ route('employee_disaster_indeminities.employee_disaster_indeminity.index') }}"
                            class="btn btn-warning mr-5" title="Show All Disaster Indeminity">
                            {{(__('setting.cancel'))}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
