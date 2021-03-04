@extends('layouts.employee')
@section('pagetitle')
    Edit Disaster Witness
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index') }}">Disaster Witness</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-1">Edit Disaster Witness</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                action="{{ route('employee_disaster_witnesses.employee_disaster_witness.update', $employeeDisasterWitness->id) }}"
                id="edit_employee_disaster_witness_form" name="edit_employee_disaster_witness_form" accept-charset="UTF-8"
                class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                @include ('employees.disaster_witness.form', [
                'employeeDisasterWitness' => $employeeDisasterWitness,
                ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-12 text-center">
                        <input class="btn btn-primary mr-5" type="submit" value="Update">
                        <a href="{{ route('employee_disaster_witnesses.employee_disaster_witness.index') }}"
                            class="btn btn-warning mr-5" title="Show All Disaster Witness">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
