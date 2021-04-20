@extends('layouts.employee')
@section('pagetitle')
{{(__('employee.New Disaster Witness'))}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index') }}">{{(__('employee.Disaster Witness'))}}</a></li>
    <li class="breadcrumb-item active">{{(__('setting.New'))}}</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">{{(__('employee.Create New Disaster Witness'))}}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee_disaster_witnesses.employee_disaster_witness.store') }}"
                accept-charset="UTF-8" id="create_employee_disaster_witness_form"
                name="create_employee_disaster_witness_form" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include ('employees.disaster_witness.form', [
                'employeeDisasterWitness' => null,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="{{(__('setting.save'))}}">
                        <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index') }}"
                            class="btn btn-warning mr-5" title="Show All Disaster Witness">
                            {{(__('setting.cancel'))}}
                        </a>
                        <input class="btn btn-danger" type="reset" value="{{(__('setting.Reset'))}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
